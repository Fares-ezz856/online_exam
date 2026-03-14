<?php

use App\Http\Controllers\Web\Admin\WebAdminController;
use App\Http\Controllers\Web\Auth\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [WebAuthController::class, 'login']);
    Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [WebAuthController::class, 'register']);

    Route::get('/admin/login', [WebAuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [WebAuthController::class, 'adminLogin']);
});

Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware('auth:user')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Web\Student\WebStudentController::class, 'index'])->name('student.dashboard');
    Route::get('/exams/{exam}/take', [\App\Http\Controllers\Web\Student\WebStudentController::class, 'showExam'])->name('student.exams.taking');
    Route::post('/exams/{exam}/submit', [\App\Http\Controllers\Web\Student\WebStudentController::class, 'submitExam'])->name('student.exams.submit');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\Web\Admin\WebAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/deletequestion/{questionid}',[WebAdminController::class,'delete'])->name('admin.deletequestion');
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('attempts', [\App\Http\Controllers\Web\Admin\WebAdminController::class, 'attempts'])->name('attempts.index');
        Route::resource('exams', \App\Http\Controllers\Web\Admin\WebExamController::class);
        Route::post('exams/{exam}/questions', [\App\Http\Controllers\Web\Admin\WebExamController::class, 'storeQuestion'])->name('exams.questions.store');
    });
});
