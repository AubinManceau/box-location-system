<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ContractModelController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ContractController;

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

    Route::get('/tenant', [TenantController::class, 'index'])->name('tenant.index');
    Route::get('/tenant/{id}', [TenantController::class, 'show'])->name('tenant.show');
    Route::post('/tenant/create', [TenantController::class, 'create'])->name('tenant.create');
    Route::put('/tenant/{id}', [TenantController::class, 'update'])->name('tenant.update');
    Route::delete('/tenant/{id}', [TenantController::class, 'destroy'])->name('tenant.destroy');

    Route::get('/contract_model', [ContractModelController::class, 'index'])->name('contract_model.index');
    Route::get('/contract_model/{id}', [ContractModelController::class, 'show'])->name('contract_model.show');
    Route::post('/contract_model/create', [ContractModelController::class, 'create'])->name('contract_model.create');
    Route::put('/contract_model/{id}', [ContractModelController::class, 'update'])->name('contract_model.update');
    Route::delete('/contract_model/{id}', [ContractModelController::class, 'destroy'])->name('contract_model.destroy');

    Route::get('/contract/box/{id}', [ContractController::class, 'show'])->name('contract.show');
    Route::post('/contract/create', [ContractController::class, 'create'])->name('contract.create');
    Route::put('/contract/{id}', [ContractController::class, 'update'])->name('contract.update');
    Route::delete('/contract/{id}', [ContractController::class, 'destroy'])->name('contract.destroy');

    Route::get('/bill', [BillController::class, 'index'])->name('bill.index');
    Route::post('/bill/create', [BillController::class, 'create'])->name('bill.create');
    Route::get('/bill/{id}', [BillController::class, 'show'])->name('bill.show');
});

require __DIR__.'/auth.php';
