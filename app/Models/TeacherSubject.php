<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $table = 'teacher_subjects';

    /**
     * Поля, доступные для массового заполнения
     */
    protected $fillable = [
        'teacher_id',
        'subject_id'
    ];

    /**
     * Отношение к преподавателю
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /**
     * Отношение к предмету
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Отключаем автоматические временные метки
     */
    public $timestamps = false;
}
