<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeslot;
class TimeslotController extends Controller
{
    public function index()
    {
        $timeslots = Timeslot::all();
        return view('timeslot.index',compact('timeslots'));
    }
    public function create()
    {
        return view('timeslot.create');
    }
   public function store(Request $request)
    {
        $timeslot = new Timeslot;
      
        $this->validate(request(), [
            'time_slot' => 'required'
            
                      
        ]);
        $timeslot->time_slot = $request->time_slot;
        $timeslot->status = $request->status;
       
       
        $timeslot->save();
        return redirect('timeslot');
    }
    public function status()
    {
      
        $id = request('h');   
        $timeslot = Timeslot::find($id);   
         $timeslot->status = request('st');     
    
        $timeslot->save();
       
    }
}
