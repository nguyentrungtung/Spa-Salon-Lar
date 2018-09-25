<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Appointment;
use App\Employee;
use App\Services;
use App\Timeslot;
use App\complete_appointment;
use App\User;
use Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('employee')->with('timeslot')->get();
        return view('appointment.index',compact('appointments'));
    }

    public function create()
    {
        $timeslotids = Timeslot::all();
        $employeeids = Employee::all();
        $serviceids = Services::all();
        return view('appointment.create',compact('employeeids','serviceids','timeslotids'));
    }

    public function store(Request $request)
    {
        $appointment = new Appointment;
     //  $duration = Services::find($request->service_id);

        $this->validate(request(), [
            'service_id' => 'required' ,
            'employee_id' => 'required',
            'appointment_date' => 'required' ,  
            'appointment_time' => 'required' ,                  
        ]);

        $service = $request->service_id;
        $sev = Services::find($service);
        $ser_name = $sev->name;
        $h = $request->appointment_date;
        $d = $request->appointment_time;
        $app_time = Timeslot::find($d);
        $time = $app_time->time_slot;
        $e = $request->employee_id;

        $a = Appointment::where('appointment_date',$h)->where('appointment_time',$d)->where('employee_id',$e)->get();
        $c = count($a);

        if($c>0)
        {
            return back()->with('warning', 'please choose different date or time');
        }
        else
        {
            $appointment->user_id = Auth::user()->id;
            $appointment->service_id = $request->service_id;
            $appointment->employee_id = $request->employee_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->appointment_time = $request->appointment_time;
            $appointment->internal_note = $request->internal_note;
            $appointment->payment_status = $request->payment_status;
            $appointment->status = $request->status;

            if($appointment->save())
            {
                $success = 'Your appointment book successfully';
                $to      = Auth::user()->email;
                $subject = 'razoredge';            
                $message = 'your appointment was book on '.$h. ' at '.$time. ' ,service of '.$ser_name;
                $headers = 'From: saloonapp@thirstydevs.in' ;
    
                mail($to, $subject , $message, $headers);

                return redirect('appointment')->with('success', 'Appointment has been created.');

            }
        }
    }

    public function delete($id)
    {
        $app_id = Appointment::find($id);
        $app_date = $app_id->appointment_date;
        $app_time = $app_id->appointment_time;
        $service_id = $app_id->service_id;
        $u_id = $app_id->user_id;
        $a_time = Timeslot::find($app_time);
        $s_name = Services::find($service_id);
        $user = User::find($u_id);
        $service_name = $s_name->name;
        $time = $a_time->time_slot;
        $email = $user->email;

        if($app_id->delete())
        {
            $to = $email;
            $subject = 'razoredge';
            $message = 'your appointment was delete successfully which is on '.$app_date. ' at '.$time. ' ,service of '.$service_name;
            $headers = 'From: saloonapp@thirstydevs.in' ;

                mail($to, $subject , $message, $headers);
  
           return back()->with('success', 'Appointment has been deleted.');
        }


    }

    public function edit($id)
    {
        $timeslotids = Timeslot::all();
        $serviceids = Services::all();
        $appointment = Appointment::find($id);
        $sid = $appointment->service_id;
        $service = Services::find($sid);
        $empid = $service->employee_id;

        $data = array();

        foreach($empid as $eid)
        {
            $emid = Employee::find($eid);
            $fname = $emid->first_name;
            $lname = $emid->last_name;

            array_push($data, $emid);
        }
        return view('appointment.edit',compact('appointment','data','serviceids','timeslotids'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'service_id' => 'required' ,
            'appointment_date' => 'required' ,  
            'appointment_time' => 'required' ,
            'employee_id' => 'required'                  
        ]);
        $appointment = Appointment::find($id);      
        $a_date = $appointment->appointment_date;
        $a_time = $appointment->appointment_time;
        $e_id = $appointment->employee_id;
        $h = $request->appointment_date;
        $d = $request->appointment_time;
        $e = $request->employee_id;
        if($a_date != $h || $a_time != $d || $e_id != $e)
        {
          $a = Appointment::where('appointment_date',$h)->where('appointment_time',$d)->where('employee_id',$e)->get();
          $c = count($a);
          if($c>0)
          {
            return back()->with('warning', 'please choose different date or time');
          }
        }     
        $appointment = Appointment::find($id);
        $service = $request->service_id;
        $sev = Services::find($service);
        $ser_name = $sev->name;
        $h = $request->appointment_date;
        $h = $request->appointment_date;
        $d = $request->appointment_time;
        $app_time = Timeslot::find($d);
        $time = $app_time->time_slot;
        $user_id = $appointment->user_id;
        $user = User::find($user_id);
        $user_email = $user->email;
        $appointment->service_id = $request->service_id;
        $appointment->employee_id = $request->employee_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->internal_note = $request->internal_note;
        $appointment->payment_status = $request->payment_status;
        $appointment->status = $request->status;
        $appointment->save();
        // $success = 'Your appointment update successfully';
        // \Mail::raw($success, function($message){
        //     $message->to($user->email);
        // });

        $to      = $user_email;
        $subject = 'razoredge';
        $message = 'your appointment was update successfully which is on '.$h. ' at '.$time. ' ,service of '.$ser_name;
        $headers = 'From: saloonapp@thirstydevs.in' ;

        mail($to, $subject , $message, $headers);
      
        return redirect('appointment')->with('success', 'Appointment has been updated.');

    }

    public function view($id)
    {
        $appointment = Appointment::find($id);
        $a = $appointment['employee_id'];
        $b = $appointment['user_id'];
        $c = $appointment['service_id'];
        $d = $appointment['appointment_time'];

        $eid = Employee::where('id',$a)->get()->first();
        $uid = User::where('id',$b)->get()->first();
        $sid = Services::where('id',$c)->get()->first();
        $tid = Timeslot::where('id',$d)->get()->first();

        $eid->first_name;
        $eid->last_name;
        $uid->first_name;
        $uid->last_name;
        $sid->name;
        $tid->time_slot;

        $appointment['first_name']=$eid->first_name;
        $appointment['last_name']=$eid->last_name;
        $appointment['user_fname']=$uid->first_name;
        $appointment['user_lname']=$uid->last_name;
        $appointment['service_name']= $sid->name;
        $appointment['time_slot']= $tid->time_slot;
      return $appointment;

    }

    public function employee($id)
    {
        $services = Services::find($id);
        $empid = $services->employee_id;

        $data = array();
        foreach($empid as $eid)
        {
            $emid = Employee::find($eid);
            $fname = $emid->first_name;
            $lname = $emid->last_name;

            array_push($data, $emid);
        }

         return $data;

    }

    public function appointment_time($id)

    {
        $employee = Employee::find($id);
        $f_hour = $employee->from_hours;
        $to_hour = $employee->to_hours;
        $data = array();

        for($i=$f_hour;$i<=$to_hour;$i++)
        {
            $service = Timeslot::find($i);
            $timeslot = $service->time_slot;
            array_push($data, $service);
        }
        return $data;
    }
    public function deletemul(Request $request)
        {
            $category = Appointment::find($request->val);
            $category->delete();
            return back()->with('success', 'Appointment has been deleted.');
        }
        public function interval()
        {
            $date = Appointment::where('appointment_date', '<', date('Y-m-d'))->where('payment_status',1)->get();
            $appointment = new complete_appointment;
            foreach($date as $d)
            {
                $username = User::find($d->user_id);
                $user = $username->first_name . ' ' . $username->last_name;
                $appointment->user_name = $user;
                $servicename = Services::find($d->service_id);
                $service = $servicename->name;
                $appointment->service_name = $service;
                $service_duration = $servicename->houre. ':' . $servicename->minute;
                $appointment->service_duration = $service_duration;
                $price = $servicename->price;
                $appointment->price = $price;
                $employeename = Employee::find($d->employee_id);
                $employee = $employeename->first_name . ' ' . $employeename->last_name;
                $appointment->employee_name = $employee;
                $appointment->appointment_date = $d->appointment_date;
                $time = Timeslot::find($d->appointment_time);
                $t = $time->time_slot;
                $appointment->appointment_time = $t;
                $appointment->payment_status = $d->payment_status;
                $appointment->internal_note = $d->internal_note;
               if($appointment->save()) 
               {
                $d->delete();
               }
            }
        }
}

