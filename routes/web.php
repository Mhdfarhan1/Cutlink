<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - REQUEST LINK (PIK-R REQUEST)
|--------------------------------------------------------------------------
*/

// ==================== AUTHENTICATION (GUEST) ====================
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// ==================== DASHBOARD & MANAGEMENT (AUTHENTICATED) ====================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Ringkasan
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Short Link
    Route::get('/links', [ShortLinkController::class, 'index'])->name('links.index');
    Route::get('/links/create', [ShortLinkController::class, 'create'])->name('links.create');
    Route::post('/links', [ShortLinkController::class, 'store'])->name('links.store');
    Route::get('/links/{short_link}/edit', [ShortLinkController::class, 'edit'])->name('links.edit');
    Route::put('/links/{short_link}', [ShortLinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{short_link}', [ShortLinkController::class, 'destroy'])->name('links.destroy');
    Route::patch('/links/{short_link}/toggle', [ShortLinkController::class, 'toggleStatus'])->name('links.toggle');

    // QR Code
    Route::get('/links/{short_link}/qr', [ShortLinkController::class, 'qr'])->name('links.qr');
    Route::get('/links/{short_link}/qr/download/{format}', [ShortLinkController::class, 'downloadQr'])->name('links.qr.download');

    // Statistik & Analitik
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');

    // Profil & Pengaturan Akun
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ==================== SHORT LINK REDIRECTS ====================
// Prefix /r/{code} opsional
Route::get('/r/{code}', [RedirectController::class, 'handle'])->name('link.redirect.alias');

// Short code utama /{code} di baris paling bawah
Route::get('/{code}', [RedirectController::class, 'handle'])->where('code', '[a-zA-Z0-9-_]+')->name('link.redirect');
