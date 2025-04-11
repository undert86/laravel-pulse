<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject_id',
        'date',
        'status'
    ];
    protected $casts = [
        'date' => 'date'
    ];

    protected $primaryKey = 'attendance_id';

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'ID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
