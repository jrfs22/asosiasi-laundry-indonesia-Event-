<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthenticationController;


Route::middleware('guest')->group(function () {
    Route::get('', [BerandaController::class, 'index'])->name('beranda');
    // Route::get('test', function () {
    //     return view('before-login.test');
    // });

    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('', [AuthenticationController::class, 'cekLogin'])->name('cek-login');


    Route::prefix('tickets')->group(function () {
        Route::get('{name}/{participant_id}', [RegistrationController::class, 'tickets'])->name(name: 'tickets');
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
    Route::get('down', function () {
        Artisan::call('down', [
            '--secret' => 'zalamobile123',
        ]);
    });

    Route::get('up', function () {
        Artisan::call('up');
    });

    Route::get('remove-cache', [QrCodeController::class, 'removeCache']);

    Route::prefix('events')->middleware('can:view events')->group(function () {
        Route::get('', [EventsController::class, 'index'])->name('events');
    });

    Route::prefix('member')->middleware('can:view member')->group(function () {
        Route::get('', [MembersController::class, 'index'])->name('member');
    });

    Route::prefix('pendaftar')->middleware('can:view pendaftar')->group(function () {
        Route::get('', [RegistrationController::class, 'pendaftar'])->name('pendaftar');

        Route::put('{id?}', [RegistrationController::class, 'update'])->name('pendaftar.update');

        Route::get('reminder-pembayaran', [RegistrationController::class, 'sendReminderPembayaran'])->name('pendaftar.reminder-pembayaran')->middleware('can:reminder pembayaran');

        Route::get('download', [RegistrationController::class, 'download'])->name('pendaftar.download');
    });

    Route::prefix('peserta')->middleware('can:view peserta')->group(function () {
        Route::get('', [ParticipantsController::class, 'peserta'])->name('peserta');

        Route::get('reminder-acara', [ParticipantsController::class, 'EventReminder'])->name('pendaftar.reminder-acara');

        Route::get('download', [RegistrationController::class, 'downloadPeserta'])->name('pendaftar.download');
    });

    Route::prefix('qrcode')->middleware('can:view qrcode')->group(function () {
        Route::get('', [ParticipantsController::class, 'qrcode'])->name('qrcode');

        Route::get('download', [ParticipantsController::class, 'download'])->name('qrcode.download');
    });


    Route::prefix('absensi')->group(function () {
        Route::get('', [AbsensiController::class, 'absensi'])
            ->middleware('can:read absensi')
            ->name('absensi');

        Route::get('scan', [AbsensiController::class, 'scan'])
            ->middleware('can:create absensi')
            ->name('scan');

        Route::get('validate-qrcode/{name?}/{id?}', [AbsensiController::class, 'validateQrCode'])->name('absensi.validate');

        Route::delete('{event_id}/{registration_id}/{participant_id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

        Route::get('download', [AbsensiController::class, 'download'])->name('absensi.download');
    });

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});

