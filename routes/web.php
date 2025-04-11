<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    DashboardController,
    TeacherController,
    AdminController,
    GradesController,
    AttendanceController,
    MessengerController
};



// Главная страница - перенаправление на логин
Route::get('/', function () {
    return redirect()->route('login');
});

// Регистрация middleware
Route::aliasMiddleware('check.user.type', App\Http\Middleware\CheckUserType::class);

// Публичные маршруты (аутентификация)
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Общие маршруты для всех авторизованных пользователей
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/messenger', [MessengerController::class, 'index'])->name('messenger');
    Route::get('/messenger/conversation/{userId}', [MessengerController::class, 'getConversation']);
    Route::post('/messenger/send', [MessengerController::class, 'sendMessage']);
    Route::get('/messenger/new-messages/{userId}', [MessengerController::class, 'getNewMessages']);


});

// Маршруты для студентов (type=0)
Route::middleware(['auth', 'check.user.type:0'])->group(function() {
    Route::get('/grades', [GradesController::class, 'studentGrades'])->name('student.grades');

});

// Административная зона (type=2)
Route::middleware(['auth', 'check.user.type:2'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Другие админ-маршруты...
});

// Зона преподавателя (type=1)
Route::middleware(['auth', 'check.user.type:1'])->prefix('teacher')->name('teacher.')->group(function() {
    // Dashboard - только GET
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');

    // Управление оценками
    Route::prefix('grades')->group(function() {
        Route::get('/', [GradesController::class, 'index'])->name('grades.index');
        Route::get('/create', [GradesController::class, 'create'])->name('grades.create');
        Route::post('/', [GradesController::class, 'store'])->name('grades.store');
        Route::get('/{grade}/edit', [GradesController::class, 'edit'])->name('grades.edit');
        Route::put('/{grade}', [GradesController::class, 'update'])->name('grades.update');
        Route::delete('/{grade}', [GradesController::class, 'destroy'])->name('grades.destroy');
    });

    // Управление посещаемостью
    Route::prefix('attendance')->group(function() {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
        Route::get('/report', [AttendanceController::class, 'report'])->name('attendance.report');
    });

});

// Ошибка 403
Route::get('/403', function() {
    abort(403);
})->name('403');
