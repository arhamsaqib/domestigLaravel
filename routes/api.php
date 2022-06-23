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
use App\Http\Controllers\BookingReviewsController;
use App\Http\Controllers\ProviderNotificationsController;
use App\Http\Controllers\CustomerNotificationsController;
use App\Http\Controllers\ProviderServicesController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\NewCategoryController;
use App\Http\Controllers\FindProviderByLocationController;
use App\Http\Controllers\CustomerActiveBookingController;
use App\Http\Controllers\CustomerAddressesController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\RecommendedServicesController;
use App\Http\Controllers\ProviderDocumentsController;
use App\Http\Controllers\VersionCController;
use App\Http\Controllers\VersionPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserReferralController;
use App\Http\Controllers\CardStatusController;
use App\Http\Controllers\PaymentHistoryController;


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


Route::apiResource('/card-status',CardStatusController::class);
Route::apiResource('/admin',AdminController::class);
Route::apiResource('/customer',CustomerController::class);
Route::apiResource('/provider',ProviderController::class);
Route::apiResource('/provider-by-location',FindProviderByLocationController::class);
Route::apiResource('/payment-history',PaymentHistoryController::class);

Route::apiResource('/version-c',VersionCController::class);
Route::apiResource('/version-p',VersionPController::class);

Route::apiResource('/user-referrals',UserReferralController::class);
Route::post('/find-user-referral', [UserReferralController::class,'findUserReferral']);

Route::apiResource('/bookings',BookingsController::class);
Route::get('/show-provider-bookings/{providerId}', [BookingsController::class,'providerBookings']);
Route::get('/get-booking-by-id/{bookingId}', [BookingsController::class,'getbookingById']);

Route::get('/find-invoices', [InvoicesController::class,'findInvoices']);

Route::apiResource('/booking-submission',BookingSubmissionController::class);
Route::apiResource('/booking-requests',BookingRequestController::class);
Route::apiResource('/provider-gallery',ProviderGalleryController::class);
Route::apiResource('/invoices',InvoicesController::class);
Route::apiResource('/categories',CategoriesController::class);
Route::apiResource('/category-services',CategoryServiceController::class);
Route::apiResource('/provider-reviews',ProviderReviewsController::class);
Route::apiResource('/customer-reviews',CustomerReviewsController::class);
Route::apiResource('/booking-reviews',BookingReviewsController::class);
Route::apiResource('/new-category',NewCategoryController::class);
Route::apiResource('/customer-active-booking',CustomerActiveBookingController::class);
Route::apiResource('/customer-addresses',CustomerAddressesController::class);
Route::apiResource('/banners',BannersController::class);
Route::apiResource('/recommended',RecommendedServicesController::class);
Route::apiResource('/provider-documents',ProviderDocumentsController::class);
Route::apiResource('/dashboard-stats',DashboardController::class);

Route::apiResource('/provider-services',ProviderServicesController::class);
Route::post('/provider-services-by-categoryname', [ProviderServicesController::class,'showProviderServicesByCategory']);

Route::get('/customer-notification-count/{id}', [CustomerNotificationsController::class,'getCustomerUnreadNotificationCount']);
Route::get('/provider-mark-read-notifications/{id}', [ProviderNotificationsController::class,'markAsReadNotificationsProvider']);
Route::get('/customer-mark-read-notifications/{id}', [CustomerNotificationsController::class,'markAsReadNotificationsCustomer']);
Route::apiResource('/customer-notifications',CustomerNotificationsController::class);
Route::apiResource('/provider-notifications',ProviderNotificationsController::class);

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
Route::post('/upload-image', [ImageController::class,'addimage']);


//Admin API's
Route::apiResource('/services',ServicesController::class);
