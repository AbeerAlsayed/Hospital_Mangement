<?php

use Illuminate\Support\Facades\Route;
use Modules\Shifts\Http\Controllers\ShiftsController;

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


Route::prefix('shift-schedules')->group(function () {
    Route::post('/', [ShiftsController::class, 'store']);
    Route::put('/{shiftSchedule}', [ShiftsController::class, 'update']);
    Route::delete('/{shiftSchedule}', [ShiftsController::class, 'destroy']);
    Route::get('/', [ShiftsController::class, 'index']);
    Route::get('/{shiftSchedule}', [ShiftsController::class, 'show']);
});
