<?php

use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

// API Routes dengan rate limiting untuk keamanan
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/v1/transaksi', [TransactionController::class, 'store']);
    Route::get('/v1/transaksi', [TransactionController::class, 'index']);
    Route::delete('/v1/transaksi/{nomorTransaksi}', [TransactionController::class, 'destroy']);
    Route::get('/v1/dashboard/top-products', [DashboardController::class, 'topProducts']);
    Route::get('/v1/dashboard/monthly-summary', [DashboardController::class, 'monthlySummary']);
});