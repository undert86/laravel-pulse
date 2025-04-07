<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;

class grade extends Model
{
    protected $fillable = [
        'student_id', 'subject_id', 'teacher_id',
        'grade', 'comment', 'date'
    ];

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
