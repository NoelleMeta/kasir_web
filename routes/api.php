<?php

use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/transaksi', [TransactionController::class, 'store']);
Route::get('/v1/dashboard/top-products', [DashboardController::class, 'topProducts']);
Route::get('/v1/dashboard/monthly-summary', [DashboardController::class, 'monthlySummary']);
Route::post('/v1/transaksi', [TransactionController::class, 'store']);
<<<<<<< HEAD
Route::get('/v1/transaksi', [TransactionController::class, 'index']);
Route::delete('/v1/transaksi/{nomorTransaksi}', [TransactionController::class, 'destroy']);
=======
Route::get('/v1/transaksi', [TransactionController::class, 'index']);
>>>>>>> b0c78feede0abf3b8b2f0ce3365d96f03e64d72b
