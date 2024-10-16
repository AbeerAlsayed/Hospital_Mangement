<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\LaboratoryController;
use Modules\Services\Http\Controllers\RayController;
use Modules\Services\Http\Controllers\ServicesController;

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




Route::prefix('rays')->group(function () {
    Route::get('/', [RayController::class, 'index']);
    Route::get('/{ray}', [RayController::class, 'show']);
    Route::post('/', [RayController::class, 'store']);
    Route::put('/{ray}', [RayController::class, 'update']);
    Route::delete('/{ray}', [RayController::class, 'destroy']);
});


Route::prefix('laboratories')->group(function () {
    Route::post('/', [LaboratoryController::class, 'store']);
    Route::put('/{laboratory}', [LaboratoryController::class, 'update']);
    Route::delete('/{laboratory}', [LaboratoryController::class, 'destroy']);
    Route::get('/', [LaboratoryController::class, 'index']);
    Route::get('/{laboratory}', [LaboratoryController::class, 'show']);
});
