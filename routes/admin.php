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
use Src\Features\Permission\Presentaion\Controller\PermissionController;
use Src\Features\Permission\Presentaion\Controller\RoleController;
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

Route::get('login', [DashAdminController::class,'goToLoginBlade'])->name('login_admin_form');
Route::post('login', [DashAdminController::class,'login'])->name('login');

Route::group(['middleware' => 'auth:admin'], function()
{

// =========== Start State Code ============ //
    Route::get('states', [DashStateController::class,'index'])->name('states');
    Route::get('add_state', function () {return view('dashboard.states.add');})->name('add_state_form');
    Route::post('add_state', [DashStateController::class,'create'])->name('submit_add_state');
    Route::get('edite_state', [DashStateController::class,'goToEditeBlade'])->name('edite_state_form');
    Route::post('edite_state', [DashStateController::class,'update'])->name('edite_state');
    Route::get('delete_state', [DashStateController::class,'delete'])->name('delete_state');
// =========== End State Code ============ //

// =========== Start [CITY] Code ============ //
    Route::get('cities', [DashCityController::class,'index'])->name('cities');
    Route::get('add_city', [DashCityController::class,'goToAddBlade'])->name('add_city_form');
    Route::post('add_city', [DashCityController::class,'create'])->name('submit_add_city');
    Route::get('edite_city', [DashCityController::class,'goToEditeBlade'])->name('edite_city_form');
    Route::post('edite_city', [DashCityController::class,'update'])->name('edite_city');
    Route::get('delete_city', [DashCityController::class,'delete'])->name('delete_city');
// =========== End [CITY] Code ============ //


// =========== Start [SERVICE] Code ============ //
    Route::get('services', [DashServiceController::class,'index'])->name('services');
    Route::get('add_service', [DashServiceController::class,'goToAddBlade'])->name('add_service_form');
    Route::post('add_service', [DashServiceController::class,'create'])->name('submit_add_service');
    Route::get('edite_service', [DashServiceController::class,'goToEditeBlade'])->name('edite_service_form');
    Route::post('edite_service', [DashServiceController::class,'update'])->name('edite_service');
    Route::get('delete_service', [DashServiceController::class,'delete'])->name('delete_service');
// =========== End [SERVICE] Code ============ //


// =========== Start [ADDRESS TYPES] Code ============ //
    Route::get('address_types', [DashAddressTypeController::class,'index'])->name('address_types');
    Route::get('add_address_type', [DashAddressTypeController::class,'goToAddBlade'])->name('add_address_type_form');
    Route::post('add_address_type', [DashAddressTypeController::class,'create'])->name('submit_add_address_type');
    Route::get('edite_address_type', [DashAddressTypeController::class,'goToEditeBlade'])->name('edite_address_type_form');
    Route::post('edite_address_type', [DashAddressTypeController::class,'update'])->name('edite_address_type');
    Route::get('delete_address_type', [DashAddressTypeController::class,'delete'])->name('delete_address_type');
// =========== End [ADDRESS TYPES] Code ============ //


// =========== Start [CANCEL REASON] Code ============ //
    Route::get('cancel_reasons', [DashCancelReasonController::class,'index'])->name('cancel_reasons');
    Route::get('add_cancel_reason', [DashCancelReasonController::class,'goToAddBlade'])->name('add_cancel_reason_form');
    Route::post('add_cancel_reason', [DashCancelReasonController::class,'create'])->name('submit_add_cancel_reason');
    Route::get('edite_cancel_reason', [DashCancelReasonController::class,'goToEditeBlade'])->name('edite_cancel_reason_form');
    Route::post('edite_cancel_reason', [DashCancelReasonController::class,'update'])->name('edite_cancel_reason');
    Route::get('delete_cancel_reason', [DashCancelReasonController::class,'delete'])->name('delete_cancel_reason');
// =========== End [CANCEL REASON] Code ============ //


// =========== Start [ADD SLIDER] Code ============ //
    Route::get('sliders', [DashSliderController::class,'index'])->name('sliders');
    Route::get('add_slider', [DashSliderController::class,'goToAddBlade'])->name('add_slider_form');
    Route::post('add_slider', [DashSliderController::class,'create'])->name('submit_add_slider');
    Route::get('edite_slider', [DashSliderController::class,'goToEditeBlade'])->name('edite_slider_form');
    Route::post('edite_slider', [DashSliderController::class,'update'])->name('edite_slider');
    Route::get('delete_slider', [DashSliderController::class,'delete'])->name('delete_slider');
// =========== End [ADD SLIDER] Code ============ //


// =========== Start [PACKAGE] Code ============ //
    Route::get('packages', [DashPackageController::class,'index'])->name('packages');
    Route::get('add_package', [DashPackageController::class,'goToAddBlade'])->name('add_package_form');
    Route::post('add_package', [DashPackageController::class,'create'])->name('submit_add_package');
    Route::get('edite_package', [DashPackageController::class,'goToEditeBlade'])->name('edite_package_form');
    Route::post('edite_package', [DashPackageController::class,'update'])->name('edite_package');
    Route::get('delete_package', [DashPackageController::class,'delete'])->name('delete_package');
// =========== End [PACKAGE] Code ============ //


// =========== Start [ADMIN] Code ============ //
    Route::get('admins', [DashAdminController::class,'index'])->name('admins');
    Route::get('add_admin', [DashAdminController::class,'goToAddBlade'])->name('add_admin_form');
    Route::post('add_admin', [DashAdminController::class,'create'])->name('submit_add_admin');
    Route::get('edite_admin', [DashAdminController::class,'goToEditeBlade'])->name('edite_admin_form');
    Route::post('edite_admin', [DashAdminController::class,'update'])->name('edite_admin');
    Route::get('delete_admin', [DashAdminController::class,'delete'])->name('delete_admin');
    Route::get('logout', [DashAdminController::class,'logout'])->name('logout_admin');
// =========== End [ADMIN] Code ============ //



// =========== Start [Role] Code ============ //
    Route::get('roles', [RoleController::class,'index'])->name('roles');
    Route::get('add_role', [RoleController::class,'goToAddBlade'])->name('add_role_form');
    Route::post('add_role', [RoleController::class,'create'])->name('submit_add_role');
    Route::get('edite_role', [RoleController::class,'goToEditeBlade'])->name('edite_role_form');
    Route::post('edite_role', [RoleController::class,'update'])->name('edite_role');
    Route::get('delete_role', [RoleController::class,'delete'])->name('delete_role');
// =========== End [Role] Code ============ //


// =========== Start [PERMISSION] Code ============ //
    Route::get('permissions', [PermissionController::class,'index'])->name('permissions');
    Route::get('add_permission', [PermissionController::class,'goToAddBlade'])->name('add_permission_form');
    Route::post('add_permission', [PermissionController::class,'create'])->name('submit_add_permission');
    Route::get('edite_permission', [PermissionController::class,'goToEditeBlade'])->name('edite_permission_form');
    Route::post('edite_permission', [PermissionController::class,'update'])->name('edite_permission');
    Route::get('delete_permission', [PermissionController::class,'delete'])->name('delete_permission');
// =========== End [PERMISSION] Code ============ //



    Route::get('users', [DashUserController::class,'index'])->name('users');
    Route::get('barbers', [DashBarberController::class,'index'])->name('barbers');
    Route::get('bookings', [DashBookingController::class,'index'])->name('bookings');

});




Route::get('/', function () {
    return view('layouts.masterlayout');
//    Test::applyServerStorage();
});
