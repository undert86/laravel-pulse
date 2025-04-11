<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $primaryKey = 'teacher_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'teacher_id');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
