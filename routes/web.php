<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController; // Controller laporan milik User utama
use App\Http\Controllers\AdminLaporanController; // ✔️ TAMBAHKAN INI UNTUK ADMIN
use App\Http\Controllers\DashboardController; // Controller admin
use App\Http\Controllers\UserController; // Controller admin
use App\Http\Controllers\PengaturanController; // Controller admin
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - RoadCare (GABUNGAN USER & ADMIN FINAL)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. HALAMAN AUTENTIKASI (LOGIN / LOGOUT)
// ==========================================
Route::middleware('guest')->group(function () {
    // Halaman Login Utama (Muncul Paling Awal)
    Route::get('/', function () {
        return view('pages.login');
    })->name('login');

    // Proses Submit Form Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Proses Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ==========================================
// 2. ROUTE UNTUK USER BIASA (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    // Beranda User
    Route::get('/home', [LaporanController::class, 'home'])->name('home');

    // Peta/Map User
    Route::get('/map', [LaporanController::class, 'map'])->name('map');

    // Profil User
    Route::get('/profil', function () {
        return view('pages.profil');
    })->name('profil');

    // Manajemen Laporan dari Sisi User (Masyarakat)
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/{id}', [LaporanController::class, 'show'])->name('show');
        Route::prefix('create')->group(function () {
            Route::get('/', [LaporanController::class, 'create'])->name('create');
            Route::post('/store', [LaporanController::class, 'store'])->name('store');
        });
    });
});


// ==========================================
// 3. ROUTE UNTUK ADMIN (Wajib Login + Prefix: /admin)
// ==========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin (/admin/dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Peta/Map Khusus Admin (/admin/map)
    Route::get('/map', [DashboardController::class, 'map'])->name('map'); 

    // User Management oleh Admin (/admin/user)
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Pengaturan oleh Admin (/admin/pengaturan)
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // ✔️ PERBAIKAN: Sekarang rute laporan admin memanggil AdminLaporanController
    Route::resource('laporan', AdminLaporanController::class); 
});