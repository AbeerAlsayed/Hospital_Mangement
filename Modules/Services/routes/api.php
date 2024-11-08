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




// مسارات "rays"
Route::group(['prefix' => 'rays'], function () {
    Route::get('/', [RayController::class, 'index']);
    Route::get('filter-rays', [RayController::class, 'filterRays']);
    Route::get('/{ray}', [RayController::class, 'show']);

    Route::middleware(['auth:api', 'role:doctor'])->group(function () {
        Route::post('/', [RayController::class, 'store']);
        Route::put('/{ray}', [RayController::class, 'update']);
        Route::delete('/{ray}', [RayController::class, 'destroy']);
    });
});

// مسارات "laboratories"
Route::group(['prefix' => 'laboratories'], function () {
    Route::get('/', [LaboratoryController::class, 'index']);
    Route::get('filter', [LaboratoryController::class, 'filterLaboratories']);
    Route::get('/{laboratory}', [LaboratoryController::class, 'show']);

    Route::middleware(['auth:api', 'role:doctor'])->group(function () {
        Route::post('/', [LaboratoryController::class, 'store']);
        Route::put('/{laboratory}', [LaboratoryController::class, 'update']);
        Route::delete('/{laboratory}', [LaboratoryController::class, 'destroy']);
    });
});

