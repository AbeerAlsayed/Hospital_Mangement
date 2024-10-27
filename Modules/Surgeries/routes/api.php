<?php

use Illuminate\Support\Facades\Route;
use Modules\Surgeries\Http\Controllers\SurgeriesController;
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
    Route::get('/', [SurgeriesController::class, 'index']);
    Route::post('/', [SurgeriesController::class, 'store']);
    Route::get('/{id}', [SurgeriesController::class, 'show']);
    Route::put('/{id}', [SurgeriesController::class, 'update']);
    Route::delete('/{id}', [SurgeriesController::class, 'destroy']);
});

Route::prefix('ambulances')->group(function () {
    Route::get('/', [AmbulanceController::class, 'index']);
    Route::post('/', [AmbulanceController::class, 'store']);
    Route::get('/{id}', [AmbulanceController::class, 'show']);
    Route::put('/{id}', [AmbulanceController::class, 'update']);
    Route::delete('/{id}', [AmbulanceController::class, 'destroy']);
});
