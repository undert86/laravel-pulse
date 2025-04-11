<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $primaryKey = 'subject_id';

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'teacher_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'subject_id');
    }
}
