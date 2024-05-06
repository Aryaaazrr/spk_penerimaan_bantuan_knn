<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    // Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::get('/', [AuthController::class, 'create'])->name('login');
    Route::post('/', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria');
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('kriteria/update', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    Route::get('sub-kriteria', [SubKriteriaController::class, 'index'])->name('subkriteria');
    Route::post('sub-kriteria', [SubKriteriaController::class, 'store'])->name('subkriteria.store');
    Route::put('sub-kriteria/update', [SubKriteriaController::class, 'update'])->name('subkriteria.update');
    Route::delete('sub-kriteria/{id}', [SubKriteriaController::class, 'destroy'])->name('subkriteria.destroy');

    Route::get('training', [TrainingController::class, 'index'])->name('training');
    Route::post('training', [TrainingController::class, 'store'])->name('training.store');
    Route::put('training/update', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');

    Route::get('analisa', [AnalisaController::class, 'index'])->name('analisa');
    Route::get('analisa/data', [AnalisaController::class, 'show'])->name('analisa.data');
    Route::get('analisa/klasifikasi', [AnalisaController::class, 'klasifikasi'])->name('analisa.klasifikasi');
    Route::post('analisa', [AnalisaController::class, 'store'])->name('analisa.store');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('cetak-laporan', [LaporanController::class, 'printReport'])->name('laporan.cetak');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});