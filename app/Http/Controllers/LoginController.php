<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);



        // Стандартная аутентификация Laravel
        if (Auth::attempt($credentials)) {
            return $this->redirectByUserType(auth()->user());
        }

        return back()->withErrors([
            'username' => 'Неверные учетные данные',
        ]);
    }

    protected function redirectByUserType($user)
    {
        switch ($user->type) {
            case User::TYPE_ADMIN:
                return redirect()->route('admin.dashboard');
            case User::TYPE_TEACHER:
                return redirect()->route('teacher.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
