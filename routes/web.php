<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;

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
// V2 (Desain Tradisional) sekarang menjadi halaman utama (default)
Route::get('/', [LandingPageController::class, 'indexV2'])->name('landing');

// Tetap sediakan route eksplisit untuk V2 (opsional)
Route::get('/v2', [LandingPageController::class, 'indexV2'])->name('landing.v2');

// V1 (Desain Modern) sekarang dapat diakses melalui /v1
Route::get('/v1', [LandingPageController::class, 'index'])->name('landing.v1');

// Rute pendukung untuk landing page
Route::get('/menu-pdf', [MenuController::class, 'showPdf'])->name('menu.daftar');
Route::get('/map', [MapController::class, 'redirectToGoogleMaps'])->name('map.redirect');


// --- Admin Authentication Routes ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- Admin Panel Routes (Dilindungi oleh Auth) ---
Route::middleware(['auth'])->group(function () {

    // Manajemen Akun (Semua role bisa akses)
    Route::get('/admin/account', [AuthController::class, 'showAccountPage'])->name('admin.account');
    Route::post('/admin/account', [AuthController::class, 'updateAccount'])->name('admin.account.update');

    // Dashboard - Superadmin & Kasir
    Route::middleware(['role:superadmin,kasir'])->group(function () {
        Route::get('/admin/dashboard', [ReportController::class, 'dashboard'])->name('admin.dashboard');
        
        // Laporan - Superadmin & Kasir
        Route::get('/admin/laporan/ringkas', [ReportController::class, 'ringkas'])->name('laporan.ringkas');
        Route::get('/admin/laporan/detail', [ReportController::class, 'detail'])->name('laporan.detail');
        Route::get('/admin/laporan/ringkas/excel', [ReportController::class, 'exportRingkasExcel'])->name('laporan.ringkas.excel');
        Route::get('/admin/laporan/ringkas/pdf', [ReportController::class, 'exportRingkasPdf'])->name('laporan.ringkas.pdf');
        Route::get('/admin/laporan/detail/excel', [ReportController::class, 'exportDetailExcel'])->name('laporan.detail.excel');
        Route::get('/admin/laporan/detail/pdf', [ReportController::class, 'exportDetailPdf'])->name('laporan.detail.pdf');
    });

    // Manajemen Landing Page - Superadmin & Sosmed
    Route::middleware(['role:superadmin,sosmed'])->group(function () {
        Route::get('/admin/landing-page', [LandingPageController::class, 'showAdminPage'])->name('landing-page.admin');
        Route::post('/admin/landing-page/background', [LandingPageController::class, 'uploadBackground'])->name('landing-page.upload-background');
        Route::post('/admin/landing-page/reset-background', [LandingPageController::class, 'resetBackground'])->name('landing-page.reset-background');
        Route::post('/admin/landing-page/menu/{id}', [LandingPageController::class, 'updateMenu'])->name('landing-page.update-menu');
        Route::post('/admin/landing-page/kontak', [LandingPageController::class, 'updateKontak'])->name('landing-page.update-kontak');
        Route::post('/admin/landing-page/about', [LandingPageController::class, 'updateAbout'])->name('landing-page.update-about');
        Route::post('/admin/landing-page/menu-deskripsi', [LandingPageController::class, 'updateMenuDeskripsi'])->name('landing-page.update-menu-deskripsi');
        Route::post('/admin/landing-page/menu-pdf', [LandingPageController::class, 'uploadMenuPdf'])->name('landing-page.upload-menu-pdf');
        Route::post('/admin/landing-page/koordinat', [LandingPageController::class, 'updateKoordinat'])->name('landing-page.update-koordinat');
    });

    // Manajemen User - Hanya Superadmin
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('admin/users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
    });

});
