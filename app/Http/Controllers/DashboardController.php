<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = Auth::id();

        $attendances = Attendance::with(['teacher', 'subject'])
            ->where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('dashboard', compact('attendances'));
    }

}
