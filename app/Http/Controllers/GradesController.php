<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class GradesController extends Controller
{
    // Список оценок для преподавателя
    public function index()
    {
        // Получаем ID текущего преподавателя
        $teacherId = Auth::user()->teachers->teacher_id;

        // Получаем оценки, которые выставил этот преподаватель
        $grades = Grade::with(['student', 'subject'])
            ->where('teacher_id', $teacherId)
            ->orderBy('date', 'desc')
            ->get();

        return view('teacher.grades.index', compact('grades'));
    }

    // Форма создания новой оценки
    public function create()
    {
        $teacherId = Auth::user()->teachers->teacher_id;

        // Получаем студентов и предметы, которые ведет преподаватель
        $students = User::where('type', 0)->get();
        $subjects = Subject::all(); // Или более точный запрос если есть связь преподаватель-предметы

        return view('teacher.grades.create', compact('students', 'subjects'));
    }

    // Сохранение новой оценки
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,ID',
            'subject_id' => 'required|exists:subjects,subject_id',
            'grade' => 'required|integer|between:2,5',
            'comment' => 'nullable|string|max:255',
        ]);

        Grade::create([
            'student_id' => $validated['student_id'],
            'teacher_id' => auth()->user()->teacher->teacher_id,
            'subject_id' => $validated['subject_id'],
            'grade' => $validated['grade'],
            'comment' => $validated['comment'],
            'date' => now(),
        ]);

        return back()->with('success', 'Оценка успешно сохранена');
    }

    // Форма редактирования оценки
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $this->authorize('update', $grade); // Проверка прав

        $students = User::where('type', 0)->get();
        $subjects = Subject::all();

        return view('teacher.grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Обновление оценки
    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        $this->authorize('update', $grade); // Проверка прав

        $validated = $request->validate([
            'student_id' => 'required|exists:users,ID',
            'subject_id' => 'required|exists:subjects,subject_id',
            'grade' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255'
        ]);

        $grade->update($validated);

        return redirect()->route('teacher.grades.index')
            ->with('success', 'Оценка успешно обновлена');
    }

    // Удаление оценки
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $this->authorize('delete', $grade); // Проверка прав

        $grade->delete();

        return redirect()->route('teacher.grades.index')
            ->with('success', 'Оценка успешно удалена');
    }

    // Просмотр оценок для студента

}
