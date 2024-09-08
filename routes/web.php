<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ParticipantsController;
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

    Route::prefix('member')->group(function () {
        Route::get('{phone_number}', [MembersController::class, 'isMember'])->name('member.check');
    });
});


Route::middleware('auth')->group(function () {
    Route::prefix('events')->group(function () {
        Route::get('', [EventsController::class, 'index'])->name('events');
    });

    Route::prefix('pendaftar')->group(function () {
        Route::get('', [ParticipantsController::class, 'index'])->name('pendaftar');
    });

    Route::prefix('member')->group(function () {
        Route::get('', [MembersController::class, 'index'])->name('member');
    });

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

