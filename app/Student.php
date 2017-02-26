<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['class_id', 'first_name', 'last_name', 'created_at', 'updated_at'];

    function mClass()
    {
        return $this->belongsTo(mClass::class);
    }
}
