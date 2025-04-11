<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;

class grade extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject_id',
        'grade',
        'comment',
        'date'
    ];
    protected $primaryKey = 'grade_id';

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
