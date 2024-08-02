<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\homeController;
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
Route::get('user', [AuthController::class, 'user']);
Route::post('logout', [AuthController::class, 'logout']);


Route::group([], function () {
    //this main api routes
    Route::get('shipments', [homeController::class, 'userShipments']);
    Route::post('shipments/search', [homeController::class, 'search']);
    Route::get('shipments/pending', [homeController::class, 'pendingShipments']);
    Route::get('shipments/delivered', [homeController::class, 'deliveredShipments']);

    

});
