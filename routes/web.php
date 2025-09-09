<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', [ReportController::class, 'dashboard'])->name('dashboard');

Route::get('/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
Route::get('/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');

// --- ROUTE BARU UNTUK EKSPOR ---
Route::get('/laporan/ringkas/excel', [ReportController::class, 'exportRingkasExcel'])->name('laporan.ringkas.excel');
Route::get('/laporan/ringkas/pdf', [ReportController::class, 'exportRingkasPdf'])->name('laporan.ringkas.pdf');

Route::get('/laporan/detail/excel', [ReportController::class, 'exportDetailExcel'])->name('laporan.detail.excel');
Route::get('/laporan/detail/pdf', [ReportController::class, 'exportDetailPdf'])->name('laporan.detail.pdf');
