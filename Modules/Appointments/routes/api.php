<?php

use Illuminate\Support\Facades\Route;
use Modules\Appointments\Http\Controllers\AppointmentsController;

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

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentsController::class, 'index']);
    Route::post('/', [AppointmentsController::class, 'store']);
    Route::get('/{id}', [AppointmentsController::class, 'show']);
    Route::put('/{id}', [AppointmentsController::class, 'update']);
    Route::delete('/{id}', [AppointmentsController::class, 'destroy']);
});
