<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - RoadCare (GABUNGAN USER & ADMIN FINAL)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. HALAMAN AUTENTIKASI (LOGIN / REGISTER / LOGOUT)
// ==========================================
Route::middleware('guest')->group(function () {
    // Halaman Login Utama
    Route::get('/', function () {
        return view('pages.login');
    })->name('login');

    // Proses Submit Form Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // ✅ HALAMAN REGISTER
    Route::get('/register', function () {
        return view('pages.register');
    })->name('register');

    // ✅ PROSES SUBMIT FORM REGISTER
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
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

    // ==========================================
    // Manajemen Laporan User (Masyarakat)
    // ==========================================
    Route::prefix('laporan')->name('laporan.')->group(function () {

        // List semua laporan user
        Route::get('/', [LaporanController::class, 'index'])->name('index');

        // ✅ FORM TAMBAH LAPORAN (HARUS SEBELUM /{id})
        Route::get('/create', [LaporanController::class, 'create'])->name('create');

        // ✅ PROSES SIMPAN LAPORAN
        Route::post('/', [LaporanController::class, 'store'])->name('store');

        // ✅ DETAIL LAPORAN (PALING BAWAH)
        Route::get('/{id}', [LaporanController::class, 'show'])->name('show');
    });
});


// ==========================================
// 3. ROUTE UNTUK ADMIN (Wajib Login + Prefix: /admin)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Peta/Map Khusus Admin
    Route::get('/map', [DashboardController::class, 'map'])->name('map');

    // User Management oleh Admin
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Pengaturan oleh Admin
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // ==========================================
    // Manajemen Laporan Admin (CRUD Lengkap)
    // ==========================================
    Route::resource('laporan', AdminLaporanController::class)->only(['index', 'show', 'destroy']);

    Route::put('/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::get('/laporan/{id}/download', [AdminLaporanController::class, 'download'])->name('laporan.download');
});