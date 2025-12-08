<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Customers
Route::resource('customers', CustomerController::class);

// Nested Hutang & Pembayaran
Route::prefix('customers/{customer}')->group(function () {

    // Hutang
    Route::get('debts', [DebtController::class, 'index'])->name('debts.index');
    Route::get('debts/create', [DebtController::class, 'create'])->name('debts.create');
    Route::post('debts', [DebtController::class, 'store'])->name('debts.store');
    Route::get('debts/{debt}/edit', [DebtController::class, 'edit'])->name('debts.edit');
    Route::put('debts/{debt}', [DebtController::class, 'update'])->name('debts.update');
    Route::delete('debts/{debt}', [DebtController::class, 'destroy'])->name('debts.destroy');

    // Pembayaran
    Route::get('debts/{debt}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('debts/{debt}/payments', [PaymentController::class, 'store'])->name('payments.store');
});
