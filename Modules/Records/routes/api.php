<?php

use Illuminate\Support\Facades\Route;
use Modules\Records\Http\Controllers\PrescriptionController;
use Modules\Records\Http\Controllers\PatientMovementController;
use Modules\Records\Http\Controllers\RecordsController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('medical-records')->group(function () {
    Route::get('/', [RecordsController::class, 'index']);
    Route::post('/', [RecordsController::class, 'store']);
    Route::get('/{id}', [RecordsController::class, 'show']);
    Route::put('/{id}', [RecordsController::class, 'update']);
    Route::delete('/{id}', [RecordsController::class, 'destroy']);
});

Route::prefix('prescriptions')->group(function () {
    Route::get('/', [PrescriptionController::class, 'index']);
    Route::post('/', [PrescriptionController::class, 'store']);
    Route::get('/{id}', [PrescriptionController::class, 'show']);
    Route::put('/{id}', [PrescriptionController::class, 'update']);
    Route::delete('/{id}', [PrescriptionController::class, 'destroy']);
});

Route::prefix('patient-movements')->group(function () {
    Route::get('/', [PatientMovementController::class, 'index']);
    Route::post('/', [PatientMovementController::class, 'store']);
    Route::get('/{id}', [PatientMovementController::class, 'show']);
    Route::put('/{id}', [PatientMovementController::class, 'update']);
    Route::delete('/{id}', [PatientMovementController::class, 'destroy']);
    Route::post('/register-entry', [PatientMovementController::class, 'registerEntry']);
Route::post('/{id}/register-exit', [PatientMovementController::class, 'registerExit']);

});
