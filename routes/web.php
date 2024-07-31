<?php

use App\Http\Controllers\dashboard\ContainerController;
use App\Http\Controllers\dashboard\LocationController;
use App\Http\Controllers\dashboard\ShipmentController;
use App\Http\Controllers\dashboard\ShipmentTrackingController;
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

Route::get('/', [homeController::class, 'index'])->name('home');


Route::group([], function () {

    //this route users
    Route::resource('users', UserController::class);

    //this route containers
    Route::resource('containers', ContainerController::class);

    //this route shipments
    Route::resource('shipments', ShipmentController::class);

    //this route locations
    Route::resource('locations', LocationController::class);

    //this route shipment_trackings
    Route::resource('shipment_trackings', ShipmentTrackingController::class);



});
