<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {

    // limousine booking routes
    Route::post('/confirm-booking', [\App\Http\Controllers\BookingController::class, 'confirmBooking']);

    // vehicles routes
    Route::get('/vehicles/{type}', [\App\Http\Controllers\VehicleController::class, 'getVehiclesByType']);
    Route::get('/vehicles-availability', [\App\Http\Controllers\VehicleController::class, 'checkVehicleAvailability']);
    Route::get('/vehicle/{id}', [\App\Http\Controllers\VehicleController::class, 'getVehicle']);
});
