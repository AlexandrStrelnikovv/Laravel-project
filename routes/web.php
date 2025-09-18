<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/task', [TaskController::class, 'index'])->name('tasks.filter');
    Route::get('/task/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/user/{id}/tasks', [TaskController::class, 'show'])->name('tasks.show');

    Route::post('/task/{id}', [TaskController::class, 'completed'])->name('tasks.completed');
    Route::post('store', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('task/{id}', [TaskController::class, 'update'])->name('task.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
