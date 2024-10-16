<?php

use Illuminate\Support\Facades\Route;
use Modules\Surgeries\Http\Controllers\SurgeryController;
use Modules\Surgeries\Http\Controllers\AmbulanceController;

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

Route::prefix('surgeries')->group(function () {
    Route::get('/', [SurgeryController::class, 'index']);
    Route::post('/', [SurgeryController::class, 'store']);
    Route::get('/{id}', [SurgeryController::class, 'show']);
    Route::put('/{id}', [SurgeryController::class, 'update']);
    Route::delete('/{id}', [SurgeryController::class, 'destroy']);
});

Route::prefix('ambulances')->group(function () {
    Route::get('/', [AmbulanceController::class, 'index']);
    Route::post('/', [AmbulanceController::class, 'store']);
    Route::get('/{id}', [AmbulanceController::class, 'show']);
    Route::put('/{id}', [AmbulanceController::class, 'update']);
    Route::delete('/{id}', [AmbulanceController::class, 'destroy']);
});
