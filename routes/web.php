<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BoxController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{id}', [BoxController::class, 'show'])->name('box.show');
    Route::post('/dashboard/create', [BoxController::class, 'create'])->name('box.create');
    Route::put('/dashboard/{id}', [BoxController::class, 'update'])->name('box.update');
    Route::delete('/dashboard/{id}', [BoxController::class, 'destroy'])->name('box.destroy');
});

require __DIR__.'/auth.php';
