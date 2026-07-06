<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [LaporanController::class, 'index'])->name('home');

// Map
Route::get('/map', function () {
    return view('pages.map');
})->name('map');

// Profil
Route::get('/profil', function () {
    return view('pages.profil');
})->name('profil');

// Laporan Routes
Route::prefix('laporan')->name('laporan.')->group(function () {
    // List semua laporan
    Route::get('/', [LaporanController::class, 'index'])->name('index');

    // Show detail laporan
    Route::get('/{id}', [LaporanController::class, 'show'])->name('show');

    // Create Laporan (Multi-step)
    Route::prefix('create')->group(function () {
        Route::get('/', [LaporanController::class, 'create'])->name('create');
        Route::post('/store', [LaporanController::class, 'store'])->name('store');
    });
});
