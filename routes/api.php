<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\LocationApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteApiController;
use App\Http\Controllers\Api\StoreApiController;
use App\Models\Department;
use App\Models\Municipality;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    // Rutas para la gestión de rutas y visitas
    Route::prefix('routes')->group(function () {
        Route::post('/current', [RouteApiController::class, 'getCurrentRoute']);
        Route::post('/list', [RouteApiController::class, 'listEmployeeRoutes']);
        Route::post('/visit/update', [RouteApiController::class, 'updateVisitStatus']);
    });

    Route::post('/stores', [StoreApiController::class, 'store']);

    // Rutas para el historial de ubicación
    Route::prefix('location')->group(function () {
        Route::post('/store', [LocationApiController::class, 'store']);
        Route::get('/history', [LocationApiController::class, 'index']);
    });

    Route::get('/departments', function () {
		return Department::all();
	});

	Route::get('/municipalities/{department}', function (Department $department) {
		return $department->municipalities;
	});

	Route::get('/neighborhoods/{municipality}', function (Municipality $municipality) {
		return $municipality->neighborhoods;
	});
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// // Rutas para la gestión de rutas y visitas
// Route::prefix('routes')->group(function () {
//     Route::get('/current', [RouteApiController::class, 'getCurrentRoute']);
//     Route::get('/list', [RouteApiController::class, 'listEmployeeRoutes']);
//     Route::post('/visit/update', [RouteApiController::class, 'updateVisitStatus']);
// });
