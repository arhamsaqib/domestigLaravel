<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\BookingSubmissionController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\ProviderGalleryController;

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


Route::apiResource('/admin',AdminController::class);
Route::apiResource('/customer',CustomerController::class);
Route::apiResource('/provider',ProviderController::class);
Route::apiResource('/bookings',BookingsController::class);
Route::apiResource('/booking-submission',BookingSubmissionController::class);
Route::apiResource('/booking-requests',BookingRequestController::class);
Route::apiResource('/provider-gallery',ProviderGalleryController::class);
