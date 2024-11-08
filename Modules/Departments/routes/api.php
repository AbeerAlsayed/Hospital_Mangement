<?php

use Illuminate\Support\Facades\Route;
use Modules\Departments\Http\Controllers\DepartmentsController;
use Modules\Departments\Http\Controllers\RoomController;

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

Route::get('departments/filter-departments', [DepartmentsController::class, 'filterDepartment']);
Route::apiResource('departments', DepartmentsController::class)->only(['index', 'show']);

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::apiResource('departments', DepartmentsController::class)->except(['index', 'show']);
});

Route::get('rooms/filter-rooms', [RoomController::class, 'filterRooms']);

Route::apiResource('rooms', RoomController::class)->only(['index', 'show']);
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::apiResource('rooms', RoomController::class)->except(['index', 'show']);
});
