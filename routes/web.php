<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

<<<<<<< HEAD
// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected web routes
=======
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

>>>>>>> b0c78feede0abf3b8b2f0ce3365d96f03e64d72b
Route::middleware('auth')->group(function () {
    Route::get('/', [ReportController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/data', [ReportController::class, 'dashboardData'])->name('dashboard.data');

<<<<<<< HEAD
    // Akun
    Route::get('/akun', [AuthController::class, 'account'])->name('account.index');
    Route::post('/akun/reset', [AuthController::class, 'resetAccount'])->name('account.reset');

    Route::get('/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
    Route::get('/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');

=======
    Route::get('/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
    Route::get('/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');

>>>>>>> b0c78feede0abf3b8b2f0ce3365d96f03e64d72b
    Route::get('/laporan/ringkas/excel', [ReportController::class, 'exportRingkasExcel'])->name('laporan.ringkas.excel');
    Route::get('/laporan/ringkas/pdf', [ReportController::class, 'exportRingkasPdf'])->name('laporan.ringkas.pdf');

    Route::get('/laporan/detail/excel', [ReportController::class, 'exportDetailExcel'])->name('laporan.detail.excel');
    Route::get('/laporan/detail/pdf', [ReportController::class, 'exportDetailPdf'])->name('laporan.detail.pdf');
});
