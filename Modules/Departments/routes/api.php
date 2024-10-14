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

Route::apiResource('departments', DepartmentsController::class);

Route::apiResource('rooms', RoomController::class);
