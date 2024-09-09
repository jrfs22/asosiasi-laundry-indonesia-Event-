<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthenticationController;


Route::middleware('guest')->group(function () {
    // Route::get('qr', [QrCodeController::class, 'show']);
    // Route::get('whatsapp', [QrCodeController::class, 'whatsapp']);

    Route::get('', [BerandaController::class, 'index'])->name('beranda');
    // Route::get('test', function () {
    //     return view('before-login.test');
    // });

    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('', [AuthenticationController::class, 'cekLogin'])->name('cek-login');


    Route::prefix('tickets')->group(function () {
        Route::get('{name}/{participant_id}', [RegistrationController::class, 'tickets'])->name('tickets');
    });

    Route::prefix('registrasi')->group(function () {
        Route::get('', [RegistrationController::class, 'index'])->name('registrasi');
        Route::post('', [RegistrationController::class, 'registrasi'])->name('registrasi.store');
    });

    Route::prefix('member')->group(function () {
        Route::get('{phone_number}', [MembersController::class, 'isMember'])->name('member.check');
    });
});


Route::middleware('auth')->group(function () {
    Route::prefix('events')->middleware('can:view events')->group(function () {
        Route::get('', [EventsController::class, 'index'])->name('events');
    });

    Route::prefix('member')->middleware('can:view member')->group(function () {
        Route::get('', [MembersController::class, 'index'])->name('member');
    });

    Route::prefix('pendaftar')->middleware('can:view pendaftar')->group(function () {
        Route::get('', [RegistrationController::class, 'pendaftar'])->name('pendaftar');
        Route::put('{id?}', [RegistrationController::class, 'update'])->name('pendaftar.update');
    });

    Route::prefix('absensi')->middleware('can:view absensi')->group(function () {
        Route::get('', [ParticipantsController::class, 'absensi'])->name('absensi');
    });


    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

