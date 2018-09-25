<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Timeslot;
use App\Services;
class EmployeeController extends Controller
{
    public function index()
    {
        
       $employees = Employee::with('from_time')->with('to_time')->get();
        return view('employee.index',compact('employees'));
    }
    public function create()
    {
        $timeslotids = Timeslot::all();
        return view('employee.create',compact('timeslotids'));
    }
    public function store(Request $request)
    {
        $employee = new Employee;
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'f_hour' => 'required',
            'to_hour' => 'required',
            'status' => 'required'
            
        ]);
        if($request->f_hour == $request->to_hour)
        {
            return back()->with('warning', 'Please select valid Time Interval from hour, to hour..');
        }
        $employee->first_name = $request->fname;
        $employee->last_name = $request->lname;
        $employee->email = $request->email;
        $employee->from_hours = $request->f_hour;
        $employee->to_hours = $request->to_hour;
        if($request->hasFile('profile_image'))
        {
            //$filename = $request->profile_image->getClientOriginalName();
            $employee->profile_image = $request->profile_image->store('images'); 
        }
        $employee->status = $request->status;
       
        $employee->save();
        return redirect('employee')->with('success', 'Employee has been created.');
    }
    public function edit($id)
    {
        $timeslotids = Timeslot::all();
        $employee = Employee::find($id);
        return view('employee.edit',compact('employee','timeslotids'));
    }
    public function delete($id)
    {
        $employee = Employee::find($id);
         $e_id = $employee->id;
          $service = Services::where('employee_id',$e_id)->get()->first();
          if($service)
          {
              return back()->with('warning', 'This employee has not deleted.');
          }
          else
          {
              $employee->delete();
             return back()->with('success', 'employee has been deleted.');
          }

      
    }
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'f_hour' => 'required',
            'to_hour' => 'required',
            'status' => 'required'
            
        ]);
        $employee = Employee::find($id);
        if($request->f_hour == $request->to_hour)
        {
            return back()->with('warning', 'Please select valid Time Interval from hour, to hour..');
        }
        $employee->first_name = $request->fname;
        $employee->last_name = $request->lname;
        $employee->email = $request->email;
        $employee->from_hours = $request->f_hour;
        $employee->to_hours = $request->to_hour;
        $employee->status = $request->status;
        if($request->hasFile('profile_image'))
        {
            //$filename = $request->profile_image->getClientOriginalName();
            $employee->profile_image = $request->profile_image->store('images'); 
        }
        $employee->save();
        return redirect('employee')->with('success', 'Employee has been updated.');
    }
    public function timeslot($id)
    {
       
        $employee = Timeslot::find($id);
        $e_id = $employee->id;

        $employee1 = Timeslot::all();
       
        foreach($employee1 as $e)
        {
            if($e->status == 0)
            {
               $a = $e->max('id');
             
            }
        }
       
      
      
         $data = array();
         for($i=$e_id;$i<=$a;$i++)
         {
            $service = Timeslot::find($i);
            if($service->status == 0)
            {
                array_push($data, $service);
            }
       
         
            
         }
         return $data;
        
    }
    public function deletemul(Request $request)
    
        {
    
            $category = Employee::find($request->val);
            $service = Services::where('employee_id', 'LIKE', '%'.$request->val.'%')->get()->first();
           
            if($service)
            {
                return back()->with('warning', 'First Delete This Employee Service.');
            }
            $category->delete();
            return back()->with('success', 'Employee has been deleted.');
           
        }
}
