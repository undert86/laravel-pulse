<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function myAttendance()
    {
        $studentId = Auth::id();
        $attendances = AttendanceController::with(['teacher', 'subject'])
            ->where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('dashboard', compact('attendances'));
    }
}
