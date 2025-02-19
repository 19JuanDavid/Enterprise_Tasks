<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Gestión de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para Proyectos (solo administradores)
    /* Route::middleware(['role:admin'])->group(function () {
        Route::resource('projects', ProjectController::class);
    });
*/
    // Rutas para Tareas (accesibles para cualquier usuario autenticado)
    Route::resource('tasks', TaskController::class);
    // Rutas para Proyectos (cualquier usuario autenticado)
    Route::resource('projects', ProjectController::class);
});

require __DIR__ . '/auth.php';
