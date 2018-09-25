<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function from_time()
    {
        return $this->belongsTo('App\Timeslot', 'from_hours');
    }
    public function to_time()
    {
        return $this->belongsTo('App\Timeslot', 'to_hours');
    }
}
