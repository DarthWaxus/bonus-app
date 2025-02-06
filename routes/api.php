<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\OperationController;
use App\Http\Controllers\Api\V1\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.basic'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('customers.wallets', WalletController::class)->shallow();
        Route::apiResource('wallets.operations', OperationController::class)->shallow();
    });
});
