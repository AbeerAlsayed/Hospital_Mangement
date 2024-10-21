<?php
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\NurseController;

use Modules\Users\Http\Controllers\DoctorController;
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

Route::prefix('users')->group(function () {
    Route::post('/doctor', [UserController::class, 'storeDoctor']);
    Route::post('/patient', [UserController::class, 'storePatient']);
    Route::post('/nurse', [UserController::class, 'storeNurse']);

//    Route::get('/{id}', [UserController::class, 'show']);
//    Route::put('/{id}', [UserController::class, 'update']);
//    Route::delete('/{id}', [UserController::class, 'destroy']);
//    Route::get('/', [UserController::class, 'index']); // مسار جديد لجلب جميع المستخدمين
});



Route::group(['prefix' => 'nurses'], function () {
    Route::get('/', [NurseController::class, 'index']);
    Route::post('/', [NurseController::class, 'store']);
    Route::get('/{id}', [NurseController::class, 'show']);
    Route::put('/{id}', [NurseController::class, 'update']);
    Route::delete('/{id}', [NurseController::class, 'destroy']);
});



Route::group(['prefix' => 'doctors'], function () {
    Route::get('/', [DoctorController::class, 'index']);
    Route::post('/', [DoctorController::class, 'store']);
    Route::get('/{id}', [DoctorController::class, 'show']);
    Route::put('/{id}', [DoctorController::class, 'update']);
    Route::delete('/{id}', [DoctorController::class, 'destroy']);
});

Route::group(['prefix' => 'patients'], function () {
    Route::get('/', [PatientController::class, 'index']);
    Route::post('/', [PatientController::class, 'store']);
    Route::get('/{id}', [PatientController::class, 'show']);
    Route::put('/{id}', [PatientController::class, 'update']);
    Route::delete('/{id}', [PatientController::class, 'destroy']);
});
