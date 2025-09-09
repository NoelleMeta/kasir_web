<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/transaksi', [TransactionController::class, 'store']);
