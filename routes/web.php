<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

// Página principal.
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas para usuarios que todavía no han iniciado sesión.
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
});

// Cerrar sesión.
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rutas exclusivas del profesor.
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::resource('students', StudentController::class);
    });

// Rutas exclusivas del alumno.
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', function () {
            $student = auth()->user()->student;

            if (!$student) {
                abort(404, 'No se encontró información académica.');
            }

            return view('student.dashboard', compact('student'));
        })->name('dashboard');
    });
