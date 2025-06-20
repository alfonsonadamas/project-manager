<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class)->except(['show']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // Ver lista de usuarios
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Editar usuario
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update'); // Actualizar usuario
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Eliminar usuario
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';