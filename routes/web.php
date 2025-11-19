<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

// --- Landing Page Routes ---
// Ini adalah V1 (Desain Modern)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// (INI ADALAH TAMBAHAN BARU)
// Ini adalah V2 (Desain Tradisional)
Route::get('/v2', [LandingPageController::class, 'indexV2'])->name('landing.v2');

// Rute pendukung untuk landing page
Route::get('/menu-pdf', [MenuController::class, 'showPdf'])->name('menu.daftar');
Route::get('/map', [MapController::class, 'redirectToGoogleMaps'])->name('map.redirect');


// --- Admin Authentication Routes ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- Admin Panel Routes (Dilindungi oleh Auth) ---
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama
    Route::get('/admin/dashboard', function () {
        return view('index');
    })->name('admin.dashboard');

    // Manajemen Akun
    Route::get('/admin/account', [AuthController::class, 'showAccountPage'])->name('admin.account');
    Route::post('/admin/account', [AuthController::class, 'updateAccount'])->name('admin.account.update');

    // Laporan
    Route::get('/admin/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
    Route::get('/admin/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');
    Route::get('/admin/laporan/ringkas/export', [ReportController::class, 'exportRingkas'])->name('laporan.ringkas.export');
    Route::get('/admin/laporan/detail/export', [ReportController::class, 'exportDetail'])->name('laporan.detail.export');
    Route::get('/admin/laporan/detail-pdf/{id}', [ReportController::class, 'exportDetailPdf'])->name('laporan.detail.pdf');

    // Manajemen Landing Page
    Route::get('/admin/landing-page', [LandingPageController::class, 'showAdminPage'])->name('landing-page.admin');
    Route::post('/admin/landing-page/background', [LandingPageController::class, 'uploadBackground'])->name('landing-page.upload-background');
    Route::post('/admin/landing-page/reset-background', [LandingPageController::class, 'resetBackground'])->name('landing-page.reset-background');
    Route::post('/admin/landing-page/menu/{id}', [LandingPageController::class, 'updateMenu'])->name('landing-page.update-menu');
    Route::post('/admin/landing-page/kontak', [LandingPageController::class, 'updateKontak'])->name('landing-page.update-kontak');
    Route::post('/admin/landing-page/about', [LandingPageController::class, 'updateAbout'])->name('landing-page.update-about');
    Route::post('/admin/landing-page/menu-deskripsi', [LandingPageController::class, 'updateMenuDeskripsi'])->name('landing-page.update-menu-deskripsi');
    Route::post('/admin/landing-page/menu-pdf', [LandingPageController::class, 'uploadMenuPdf'])->name('landing-page.upload-menu-pdf');

});
