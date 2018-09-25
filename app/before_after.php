<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class before_after extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
}
