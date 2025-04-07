<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Grade;
class GradesController extends Controller
{
    public function grades()
    {
        // Получаем ID текущего аутентифицированного студента
        $studentId = Auth::id();

        // Получаем оценки студента с информацией о предметах и преподавателях
        $grades = Grade::with(['subject', 'teacher'])
            ->where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->paginate(10); // Пагинация по 10 записей

        return view('grades', compact('grades'));
    }
    public function index() {
        return view('grades');
    }
}
