<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
     public function timeslot()
    {
        return $this->belongsTo('App\Timeslot', 'appointment_time');
    }    
}
