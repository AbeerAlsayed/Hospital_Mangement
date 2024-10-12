<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\DoctorController;
use Modules\Users\Http\Controllers\NurseController;
use Modules\Users\Http\Controllers\PatientController;


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

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('users', UsersController::class)->names('users');
// });


Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
    Route::get('/', [UserController::class, 'getAll']); // مسار جديد لجلب جميع المستخدمين
});


Route::prefix('doctors')->group(function () {
    Route::post('/', [DoctorController::class, 'store']);
    Route::get('/{id}', [DoctorController::class, 'show']);
    Route::get('/', [DoctorController::class, 'getAll']);
    Route::put('/{id}', [DoctorController::class, 'update']);
    Route::delete('/{id}', [DoctorController::class, 'destroy']);
});




Route::prefix('nurses')->group(function () {
    Route::post('/', [NurseController::class, 'store']);
    Route::get('/{id}', [NurseController::class, 'show']);
    Route::get('/', [NurseController::class, 'getAll']);
    Route::put('/{id}', [NurseController::class, 'update']);
    Route::delete('/{id}', [NurseController::class, 'destroy']);
});



Route::prefix('patients')->group(function () {
    Route::post('/', [PatientController::class, 'store']);
    Route::get('/{id}', [PatientController::class, 'show']);
    Route::get('/', [PatientController::class, 'getAll']);
    Route::put('/{id}', [PatientController::class, 'update']);
    Route::delete('/{id}', [PatientController::class, 'destroy']);
});
