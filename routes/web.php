<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RewardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('', [BerandaController::class, 'index']);
    Route::get('test', function () {
        return view('before-login.test');
    });

    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('', [AuthenticationController::class, 'cekLogin'])->name('cek-login');


    Route::get('registrasi', [RegistrationController::class, 'index'])->name('registrasi');
});


Route::middleware('auth')->group(function () {
    Route::prefix('events')->group(function () {
        Route::get('', [EventsController::class, 'index'])->name('events');
    });

    Route::prefix('registrasi')->group(function () {
        Route::get('pendaftar', [RegistrationController::class, 'pendaftar'])->name('registrasi.pendaftar');
    });

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

