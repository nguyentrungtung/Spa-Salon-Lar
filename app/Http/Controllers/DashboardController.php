<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Employee;

use App\User;

use App\Services;

use App\Appointment;

use App\Dashboard;

use App\Category;

use App\Timeslot;



class DashboardController extends Controller

{

    public function index()

    {

        $employee = Employee::all();

        $user = User::all();

        $service = Services::all();

        $appointment = Appointment::all();

        

     //$new = Appointment::whereBetween('created_at',[\Carbon\Carbon::today()->startOfWeek(), \Carbon\Carbon::today()->endOfWeek()] )->get();

     $new = Appointment::whereBetween('created_at',[\Carbon\Carbon::parse('last sunday')->startOfDay(), \Carbon\Carbon::parse('next saturday')->endOfDay(), ] )->orderBy('created_at', 'desc')->get();

       $week = Appointment::whereBetween('appointment_date',[\Carbon\Carbon::parse('last sunday')->startOfDay(), \Carbon\Carbon::parse('next saturday')->endOfDay(), ] )->get();

        foreach($week as $appointments)

        {

            $id =  $appointments->id;

           $create = $appointments->created_at;

           $update = $appointments->updated_at;

        

           if($create != $update)

           {

           

            $updated[] = Appointment::find($id);

        

           }

                    

        }

       

        //$employee = Employe::all();

        return view('dashboard.index' , compact('employee','user','service','appointment','week','updated','new'));

    }

   

}

