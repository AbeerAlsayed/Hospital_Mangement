<?php
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\NurseController;
use Modules\Users\Http\Controllers\AuthController;
use Modules\Users\Http\Controllers\DoctorController;
use Modules\Users\Http\Controllers\PatientController;
use Modules\Users\Http\Controllers\UsersController;
use Modules\Users\Http\Controllers\RecordsController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth:api');
});

Route::prefix('admin')
    ->middleware(['auth:api', 'role:admin'])
    ->group(function () {
        Route::post('/doctor', [UsersController::class, 'storeDoctor']);
        Route::post('/nurse', [UsersController::class, 'storeNurse']);
    });


Route::prefix('records')->group(function () {
    Route::get('/', [RecordsController::class, 'index']);
    Route::get('/search', [RecordsController::class, 'searchByNationalNumber']);

});

Route::group(['prefix' => 'nurses'], function () {
    Route::get('/', [NurseController::class, 'index']);
    Route::get('/{id}', [NurseController::class, 'show']);

    Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::put('/{id}', [NurseController::class, 'update']);
    Route::delete('/{id}', [NurseController::class, 'destroy']);
    });
});


Route::group(['prefix' => 'doctors'], function () {
    Route::get('/', [DoctorController::class, 'index']);
    Route::get('/{id}', [DoctorController::class, 'show']);

    Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::put('/{id}', [DoctorController::class, 'update']);
    Route::delete('/{id}', [DoctorController::class, 'destroy']);
    });
});

Route::group(['prefix' => 'patients'], function () {
    Route::get('/', [PatientController::class, 'index']);
    Route::get('/search', [PatientController::class, 'findPatients']);
    Route::get('/{id}', [PatientController::class, 'show']);

    Route::middleware(['auth:api', 'role:doctor'])->group(function () {
    Route::post('/', [UsersController::class, 'storePatient']);
    Route::put('/{id}', [PatientController::class, 'update']);
    Route::delete('/{id}', [PatientController::class, 'destroy']);
    });
});







