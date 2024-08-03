<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\ContactUsController;
use App\Http\Controllers\dashboard\ContainerController;
use App\Http\Controllers\dashboard\LocationController;
use App\Http\Controllers\dashboard\ShipmentController;
use App\Http\Controllers\dashboard\ShipmentTrackingController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'customLogin'])->name('customLogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'customRegister'])->name('customRegister');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('proflie', [AuthController::class, 'profile'])->name('proflie');
Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');

Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/', [homeController::class, 'index'])->name('home');

    //this route users
    Route::resource('users', UserController::class);

    //this route containers
    Route::resource('containers', ContainerController::class);
    Route::get('containers/{container_id}/shipments', [ContainerController::class, 'containerShipments'])->name('containers.shipments');
    //this route shipments
    Route::resource('shipments', ShipmentController::class);

    //this route locations
    Route::resource('locations', LocationController::class);

    //this route shipment_trackings
    Route::resource('shipment_trackings', ShipmentTrackingController::class);

    //this route sliders
    Route::resource('sliders', SliderController::class);

    //this route contact us
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
    Route::delete('contact-us/{id}', [ContactUsController::class, 'delete'])->name('contact-us.delete');

});
