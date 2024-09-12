<?php

use App\Http\Controllers\RegistrationController;
use App\Models\RegistrationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('absensi')->group(function () {
    Route::get('{name}/{participant_id}', [RegistrationController::class, 'cekBarcode'])->name('cek-barcode');
});
