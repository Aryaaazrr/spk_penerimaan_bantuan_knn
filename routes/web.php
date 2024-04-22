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
    Route::get('/', [AuthController::class, 'index'])->name('index');
    Route::get('login', [AuthController::class, 'create'])->name('login');
    Route::post('login', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria');
    
    Route::get('sub-kriteria', [SubKriteriaController::class, 'index'])->name('subkriteria');
    
    Route::get('training', [TrainingController::class, 'index'])->name('training');
    
    Route::get('analisa', [AnalisaController::class, 'index'])->name('analisa');
    
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
    
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});