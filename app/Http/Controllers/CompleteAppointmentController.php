<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\complete_appointment;
class CompleteAppointmentController extends Controller
{
        public function index()
        {
          $appointments = complete_appointment::all();
    
            return view('completeappointment.index',compact('appointments'));
    
        }
        public function deletemul(Request $request)
        {
            $appointments = complete_appointment::find($request->val);
            $appointments->delete();
            return back()->with('success', 'Appointment has been deleted.');
        }
}
