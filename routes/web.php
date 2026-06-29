<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Home (DIPERBAIKI: diarahkan ke fungsi home() agar Beranda kembali seperti awal)
Route::get('/', [LaporanController::class, 'home'])->name('home');

// Map
Route::get('/map', [LaporanController::class, 'map'])->name('map');

// Profil
Route::get('/profil', function () {
    return view('pages.profil');
})->name('profil');

// Laporan Routes
Route::prefix('laporan')->name('laporan.')->group(function () {
    // List semua laporan (Tetap ke index untuk halaman Laporan Saya yang baru)
    Route::get('/', [LaporanController::class, 'index'])->name('index');

    // Show detail laporan
    Route::get('/{id}', [LaporanController::class, 'show'])->name('show');

    // Create Laporan (Multi-step)
    Route::prefix('create')->group(function () {
        Route::get('/', [LaporanController::class, 'create'])->name('create');
        Route::post('/store', [LaporanController::class, 'store'])->name('store');
    });
});