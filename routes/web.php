<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\LandingPageController;

// --- Landing Page Route ---
// Rute ini akan menampilkan halaman landing.blade.php saat membuka alamat utama
Route::get('/', function () {
    $settings = \App\Models\LandingPageSetting::all()->keyBy('key');
    $menuItems = [
        \App\Models\MenuUnggulan::getByUrutan(1),
        \App\Models\MenuUnggulan::getByUrutan(2),
        \App\Models\MenuUnggulan::getByUrutan(3),
        \App\Models\MenuUnggulan::getByUrutan(4),
    ];

    return view('landing', compact('settings', 'menuItems'));
})->name('landing');

// --- Authentication Routes ---
// Grup ini menangani proses login dan logout
Route::middleware('guest')->group(function () {
    // Hanya tamu (belum login) yang bisa akses halaman login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

// Rute logout hanya bisa diakses oleh yang sudah login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// --- Admin Routes ---
// Grup ini berisi semua halaman admin, memerlukan login (middleware 'auth')
// dan memiliki prefix /admin
Route::middleware('auth')->prefix('admin')->group(function () {
    // Halaman dashboard sekarang di /admin
    Route::get('/', [ReportController::class, 'dashboard'])->name('dashboard');
    // Pastikan nama rute API data dashboard tidak bentrok jika dipindah
    Route::get('/dashboard/data', [ReportController::class, 'dashboardData'])->name('dashboard.data');

    // Halaman Akun di /admin/akun
    Route::get('/akun', [AuthController::class, 'account'])->name('account.index');
    Route::post('/akun/reset', [AuthController::class, 'resetAccount'])->name('account.reset');

    // Halaman Laporan di /admin/laporan/*
    Route::get('/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
    Route::get('/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');

    Route::get('/laporan/ringkas/excel', [ReportController::class, 'exportRingkasExcel'])->name('laporan.ringkas.excel');
    Route::get('/laporan/ringkas/pdf', [ReportController::class, 'exportRingkasPdf'])->name('laporan.ringkas.pdf');

    Route::get('/laporan/detail/excel', [ReportController::class, 'exportDetailExcel'])->name('laporan.detail.excel');
    Route::get('/laporan/detail/pdf', [ReportController::class, 'exportDetailPdf'])->name('laporan.detail.pdf');

    // Halaman Landing Page Management
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing-page.index');
    Route::post('/landing-page/kontak', [LandingPageController::class, 'updateKontak'])->name('landing-page.update-kontak');
    Route::post('/landing-page/background', [LandingPageController::class, 'uploadBackground'])->name('landing-page.upload-background');
    Route::post('/landing-page/background/reset', [LandingPageController::class, 'resetBackground'])->name('landing-page.reset-background');
    Route::post('/landing-page/menu/{urutan}', [LandingPageController::class, 'updateMenuUnggulan'])->name('landing-page.update-menu');
    Route::post('/landing-page/menu-pdf', [LandingPageController::class, 'uploadMenuPdf'])->name('landing-page.upload-menu-pdf');
    Route::post('/landing-page/about', [LandingPageController::class, 'updateAbout'])->name('landing-page.update-about');
});

// Public route to display the daftar menu PDF inline
Route::get('/menu/daftar', [MenuController::class, 'daftarPdf'])->name('menu.daftar');

// Route that resolves short google maps link and redirects iframe to embed
Route::get('/map/redirect', [MapController::class, 'redirectToEmbed'])->name('map.redirect');
