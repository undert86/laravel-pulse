<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function mark(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,ID',
            'subject_id' => 'required|exists:subjects,subject_id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        Attendance::create([
            'student_id' => $validated['student_id'],
            'teacher_id' => auth()->user()->teacher->teacher_id,
            'subject_id' => $validated['subject_id'],
            'date' => $validated['date'],
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Посещаемость отмечена');
    }
}
