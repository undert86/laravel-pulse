<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grade;
use App\Models\User;

class AddGradeController extends Controller
{
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();

        return view('grades.create', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'grade' => 'required|integer|between:2,5',
            'comment' => 'nullable|string',
            'date' => 'required|date'
        ]);

        $validated['teacher_id'] = auth()->id();

        Grade::create($validated);

        return redirect()->route('grades.create')->with('success', 'Оценка успешно добавлена!');
    }

    public function index()
    {
        $grades = Grade::with(['student', 'subject', 'teacher'])
            ->where('teacher_id', auth()->id())
            ->latest()
            ->get();

        return view('grades.index', compact('grades'));
    }
}
