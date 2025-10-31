<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use Maatwebsite\Excel\Facades\Excel;

// =====================
// AUTH / LOGIN
// =====================

// Halaman login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================
// HALAMAN YANG DIJAGA (HARUS LOGIN)
// =====================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/lapdashboard', [LaporanController::class, 'dashboard'])->name('lapdashboard');

    // INPUT LAPORAN
    Route::get('/lapinput', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');

    // REKAP LAPORAN
    Route::get('/laprekap', [LaporanController::class, 'index'])->name('laporan.index');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::get('/laprekap/export', [LaporanController::class, 'exportExcel'])->name('laprekap.export');
});
