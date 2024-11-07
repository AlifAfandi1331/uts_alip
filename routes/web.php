<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;



Route::resource('pasien', PasienController::class);
Route::resource('dokter', DokterController::class);

//Route::get('pasien', [PasienController::class, 'index']);
//Route::get('pasien/buat', [PasienController::class, 'buat']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
