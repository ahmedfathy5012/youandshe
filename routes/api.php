<?php

use App\Src\Features\Statics\Presentation\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Base\Core\Storage\StorageFactory;
use Src\Features\Auth\Presentation\Controllers\BarberAuthController;

use Src\Features\Barber\Presentation\Controllers\BarberController;
use Src\Features\BaseApp\Presentation\Controllers\ServiceController;
use Src\Features\BaseApp\Presentation\Controllers\PackageController;
use Src\Features\Booking\Presentation\Controllers\BookingController;
use Src\Features\Location\Presentation\Controllers\AddressController;
use Src\Features\Slider\Presentation\Controllers\SliderController;
use Src\Features\Location\Presentation\Controllers\AddressTypeController;
use Src\Features\Blog\Presentation\Controllers\BlogController;
use Src\Features\BaseApp\Presentation\Controllers\HomeController;
use Src\Features\Auth\Presentation\Controllers\AuthController;

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


Route::get('fetch_all_services', [ServiceController::class,'index']);
Route::get('fetch_all_packages', [PackageController::class,'index']);
Route::get('fetch_all_sliders', [SliderController::class,'index']);
Route::get('fetch_all_address_types', [AddressTypeController::class,'index']);
Route::get('fetch_all_blogs', [BlogController::class,'index']);
Route::get('fetch_home', [HomeController::class,'fetchHome']);
Route::post('fetch_package_Services', [PackageController::class,'fetchPackageServices']);
Route::get('fetch_questions', [QuestionController::class,'index']);
Route::post('fetch_barber_reviews', [BarberController::class,'fetchBarberReviews']);
Route::post('fetch_available_barbers', [BarberController::class,'fetchAvailableBarbers']);
Route::post('check_price', [BookingController::class,'checkPrice']);

Route::post('register', [AuthController::class,'register']);
Route::post('check_phone', [AuthController::class,'checkPhone']);
Route::post('reset_password', [AuthController::class,'resetPassword']);
Route::post('login', [AuthController::class,'login']);


Route::group(['middleware' => 'auth:api'], function()
{
    Route::post('change_password', [AuthController::class,'changePassword']);
    Route::post('verify_phone', [AuthController::class,'verifyPhone']);
    Route::get('fetch_my_addresses', [AddressController::class,'fetchMyAddresses']);
    Route::post('add_address', [AddressController::class,'addAddress']);
    Route::post('edit_address', [AddressController::class,'editAddress']);
    Route::post('delete_address', [AddressController::class,'deleteAddress']);
    Route::post('set_address_active', [AddressController::class,'setAddressActive']);
    Route::post('add_barber_review', [BarberController::class,'addBarberReview']);
    Route::post('book_barber', [BookingController::class,'bookBarber']);
    Route::post('book_barber', [BookingController::class,'bookBarber']);
    Route::post('cancel_booking', [BookingController::class,'cancelBooking']);
    Route::get('fetch_new_bookings', [BookingController::class,'fetchNewBookings']);
    Route::get('fetch_coming_bookings', [BookingController::class,'fetchComingBookings']);
    Route::get('fetch_finish_bookings', [BookingController::class,'fetchFinishBookings']);
});



Route::group(['prefix' => '/barber',], function () {
    Route::post('register', [BarberAuthController::class,'register']);
    Route::post('login', [BarberAuthController::class,'login']);
    Route::post('check_phone', [BarberAuthController::class,'checkPhone']);
    Route::group(['middleware' => ['auth:barber']], function()
    {
        Route::post('change_password', [BarberAuthController::class,'changePassword']);
        Route::post('verify_phone', [BarberAuthController::class,'verifyPhone']);
        Route::post('refuse_booking', [BookingController::class,'refuseBooking']);
        Route::post('finish_booking', [BookingController::class,'finishBooking']);
    });
});






Route::get('/test', function () {
//    return view('welcome');
    $handler = StorageFactory::instance();
//    dd($handler);

    dd($handler->getFile());
});


Route::any('{path}', function() {
    return response()->json([
        'status' => false,
        'message' => 'Route not found'
    ], 404);
})->where('path', '.*');
