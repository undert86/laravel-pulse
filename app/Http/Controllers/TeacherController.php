<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
class TeacherController extends Controller
{
    public function dashboard()
    {
        // Проверяем, что пользователь - преподаватель
        if (!auth()->user()->teacher) {
            abort(403, 'Доступ только для преподавателей');
        }

        $teacherId = auth()->user()->teacher->teacher_id;

        return view('teacher.dashboard', [
            'students' => User::where('type', 0)->orderBy('LASTNAME')->get(),
            'subjects' => Subject::all(),
            'grades' => Grade::with(['student', 'subject'])
                ->where('teacher_id', $teacherId)
                ->orderBy('date', 'desc')
                ->get(),
            'attendances' => Attendance::with(['student', 'subject'])
                ->where('teacher_id', $teacherId)
                ->orderBy('date', 'desc')
                ->get()
        ]);
    }


}
