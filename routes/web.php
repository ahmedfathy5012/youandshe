<?php

use Illuminate\Support\Facades\Route;
use Src\Features\Admin\Presentation\Controllers\DashBoard\DashAdminController;
use Src\Features\Auth\Presentation\Controllers\DashBoard\DashUserController;
use Src\Features\Barber\Presentation\Controllers\DashBoard\DashBarberController;
use Src\Features\BaseApp\Presentation\Controllers\DashBoardControllers\DashPackageController;
use Src\Features\BaseApp\Presentation\Controllers\DashBoardControllers\DashServiceController;
use Src\Features\Booking\Presentation\Controllers\DashBoard\DashBookingController;
use Src\Features\Booking\Presentation\Controllers\DashBoard\DashCancelReasonController;
use Src\Features\Location\Presentation\DashBoardControllers\DashAddressTypeController;
use Src\Features\Location\Presentation\DashBoardControllers\DashCityController;
use Src\Features\Location\Presentation\DashBoardControllers\DashStateController;
use Src\Features\Slider\Presentation\Controllers\DashBoard\DashSliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/', function () {
    return view('layouts.masterlayout');
//    Test::applyServerStorage();
});
