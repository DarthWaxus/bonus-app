<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\OperationController;
use App\Http\Controllers\Api\V1\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.basic'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

        Route::get('customers/{customer}/wallets', [WalletController::class, 'index'])->name('customers.wallets.index');
        Route::post('customers/{customer}/wallets', [WalletController::class, 'store'])->name('customers.wallets.store');

        Route::get('wallets/{wallet}', [WalletController::class, 'show'])->name('wallets.show');
        Route::get('wallets/{wallet}/operations', [OperationController::class, 'index'])->name('wallets.operations.index');
        Route::get('operations/{operation}', [OperationController::class, 'show'])->name('operations.show');

        Route::get('wallets/{wallet}/operations/calculate', [OperationController::class, 'calculate'])->name('wallets.operations.calculate');
        Route::post('wallets/{wallet}/operations', [OperationController::class, 'store'])->name('wallets.operations.store');
        Route::post('wallets/{wallet}/operations/accrual', [OperationController::class, 'accrual'])->name('wallets.operations.accrual');
        Route::post('wallets/{wallet}/operations/purchase', [OperationController::class, 'purchase'])->name('wallets.operations.purchase');
    });
});
