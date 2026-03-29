<?php

use App\Http\Controllers\Api\WalletUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/wallet-users', [WalletUserController::class, 'store'])
        ->middleware('throttle:60,1');
    Route::post('/wallet-users/premium', [WalletUserController::class, 'updatePremium'])
        ->middleware('throttle:60,1');
    Route::post('/wallet-users/change-wallet', [WalletUserController::class, 'changeWallet'])
        ->middleware('throttle:30,1');
});
