<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public function getEmployeeIdAttribute($value)
    {
        return explode(',',$value);
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
    
}
