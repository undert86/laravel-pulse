<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Добавьте этот импорт

class AdminController extends Controller
{
    public function __construct()
    {
        // Применяем middleware для всех методов контроллера
        $this->middleware('auth');
        $this->middleware('check.user.type:2'); // Только для админов (type=2)
    }

    public function index()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        // Получаем всех пользователей с сортировкой по типу
        $users = User::orderBy('type')->get();

        // Статистика
        $stats = [
            'total_users' => User::count(),
            'teachers_count' => User::where('type', 1)->count(),
            'students_count' => User::where('type', 0)->count(),
            'admins_count' => User::where('type', 2)->count()
        ];

        return view('admin.dashboard', [
            'users' => $users, // Передаем список пользователей
            'stats' => $stats  // Передаем статистику
        ]);
    }
}
