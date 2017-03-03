<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mClass extends Model
{

    protected $table = 'classes';
    protected $fillable = ['year','label','max_students','created_at','updated_at'];
    protected $appends = array('label');

    public function getLabelAttribute()
    {
        return chr(65 + (($this->id-1)%26)) . $this->id;
    }

    function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
