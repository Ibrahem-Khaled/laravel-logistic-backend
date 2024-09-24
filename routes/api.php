<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\homeController;
use App\Http\Controllers\dashboard\ContactUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('update', [AuthController::class, 'update']);
Route::get('user', [AuthController::class, 'user']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::post('deleteAccount', [AuthController::class, 'deleteAccount']);


Route::group([], function () {
    //this main api routes
    Route::get('shipments', [homeController::class, 'userShipments']);
    Route::get('all-shipments', [homeController::class, 'allShipment']);
    Route::get('shipment/{shipmentId}', [homeController::class, 'shipment']);
    Route::post('shipments/search', [homeController::class, 'search']);
    Route::get('shipments/pending', [homeController::class, 'pendingShipments']);
    Route::get('shipments/delivered', [homeController::class, 'deliveredShipments']);
    Route::get('slides', [homeController::class, 'slides']);
    Route::get('notificatins', [homeController::class, 'notificatins']);
    Route::get('notificatins/count', [homeController::class, 'notificatinsCount']);

    //store contact us message 
    Route::post('contact-us', [ContactUsController::class, 'store']);
});
