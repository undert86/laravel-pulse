<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    DashboardController,
    TeacherController,
    AdminController,
    GradesController,
    AddGradeController
};

// Регистрация middleware
Route::aliasMiddleware('check.user.type', App\Http\Middleware\CheckUserType::class);

// Главная страница - перенаправляем на логин
Route::get('/', function () {
    return redirect()->route('login');
});

// Публичные маршруты
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'check.user.type:0'])->group(function() {
    Route::get('/grades', [GradesController::class, 'grades'])->name('grades');
});

Route::get('/403', function() {
    abort(403);
})->middleware('auth');

// Защищенные маршруты (требуется аутентификация)
Route::middleware('auth')->group(function() {
    // Общая панель для всех пользователей
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Административная зона (только для type=2)
    Route::middleware('check.user.type:2')->prefix('admin')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::delete('/grades/{id}', [AdminController::class, 'deleteGrade'])->name('admin.grades.delete');
    });

    // Панель преподавателя (только для type=1)
    Route::middleware(['auth', 'check.user.type:1'])->prefix('teacher')->group(function() {
        Route::get('/grades/create', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    });
});


Route::middleware(['auth', 'teacher'])->group(function () {
    // Оценки
    Route::get('/grades/create', [AddGradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [AddGradeController::class, 'store'])->name('grades.store');
    Route::get('/grades', [AddGradeController::class, 'index'])->name('grades.index');

});
