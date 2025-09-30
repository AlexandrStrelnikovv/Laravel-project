<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/filter', [TaskController::class, 'index'])->name('tasks.filter');
    Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/user/tasks', [TaskController::class, 'userCreatedTasks'])->name('tasks.show');

    Route::patch('/completed/{id}', [TaskController::class, 'completed'])->name('tasks.completed');
    Route::post('store', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
