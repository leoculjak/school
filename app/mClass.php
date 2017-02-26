<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mClass extends Model
{
    protected $table = 'classes';
    protected $fillable = ['year','label','max_students','created_at','updated_at'];

    function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
