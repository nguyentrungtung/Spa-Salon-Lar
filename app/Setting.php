<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function settings()
    {
        return static::latest()->first();
    }
}
