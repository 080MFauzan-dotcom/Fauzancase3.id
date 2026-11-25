<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/latihan-soal', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/latihan-soal/{subject}', [QuizController::class, 'show'])->where('subject', '[a-z0-9-]+')->name('quizzes.show');
    Route::post('/latihan-soal/{subject}', [QuizController::class, 'submit'])->where('subject', '[a-z0-9-]+')->name('quizzes.submit');
    Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
    Route::post('/tasks/{task}/restore', [TaskController::class, 'restore'])->whereNumber('task')->name('tasks.restore');
    Route::delete('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])->whereNumber('task')->name('tasks.force-delete');
    Route::resource('tasks', TaskController::class)->except(['show']);
});
