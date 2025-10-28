<?php

use App\Http\Controllers\LaporanController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// lapinput
Route::get('/lapinput', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');


// lapdashboard
Route::get('/lapdashboard', function () {
    return view('lapdashboard');
});

// laprekap
Route::get('/laprekap', [LaporanController::class, 'index'])->name('laporan.index');
Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');