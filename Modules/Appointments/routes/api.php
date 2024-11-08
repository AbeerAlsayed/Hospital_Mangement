<?php

use Illuminate\Support\Facades\Route;
use Modules\Appointments\Http\Controllers\AppointmentsController;


Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentsController::class, 'index']);
    Route::post('/', [AppointmentsController::class, 'store']);
    Route::get('/{id}', [AppointmentsController::class, 'show']);
    Route::put('/{id}', [AppointmentsController::class, 'update']);
    Route::delete('/{id}', [AppointmentsController::class, 'destroy']);
});
