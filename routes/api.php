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
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\ProviderIncomingRequestsController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ProviderReviewsController;
use App\Http\Controllers\CustomerReviewsController;

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
Route::get('/show-provider-bookings/{providerId}', [BookingsController::class,'providerBookings']);

Route::apiResource('/booking-submission',BookingSubmissionController::class);
Route::apiResource('/booking-requests',BookingRequestController::class);
Route::apiResource('/provider-gallery',ProviderGalleryController::class);
Route::apiResource('/invoices',InvoicesController::class);
Route::apiResource('/categories',CategoriesController::class);
Route::apiResource('/category-services',CategoryServiceController::class);
Route::apiResource('/provider-reviews',ProviderReviewsController::class);
Route::apiResource('/customer-reviews',CustomerReviewsController::class);

Route::get('/provider-incoming-requests/{id}', [ProviderIncomingRequestsController::class,'getProviderIncomingRequests']);
Route::post('/reject-request', [ProviderIncomingRequestsController::class,'onRejectRequest']);
Route::post('/accept-request', [ProviderIncomingRequestsController::class,'onAcceptRequest']);
Route::get('/provider-inprogress-booking/{id}', [ProviderIncomingRequestsController::class,'viewProviderInprogressBooking']);
Route::get('/verify-booking/{id}', [ProviderIncomingRequestsController::class,'markBookingAsVerified']);

Route::get('/get-provider-by-id/{id}', [ProviderController::class,'getProviderById']);
Route::get('/get-customer-by-id/{id}', [CustomerController::class,'getCustomerById']);

Route::post('/show-booking-submission', [BookingSubmissionController::class,'showSubmission']);

//Route::get('messages', 'ChatsController@fetchMessages');
// Route::post('messages', 'ChatsController@sendMessage');
Route::post('/messages', [ChatsController::class,'sendMessage']);
Route::post('/fetch-messages', [ChatsController::class,'fetchMessages']);
