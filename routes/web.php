<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\ContactUsController;
use App\Http\Controllers\dashboard\ContainerController;
use App\Http\Controllers\dashboard\LocationController;
use App\Http\Controllers\dashboard\NotificationController;
use App\Http\Controllers\dashboard\ShipmentController;
use App\Http\Controllers\dashboard\ShipmentTrackingController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\CountryController;
use App\Http\Controllers\dashboard\ShippingZoneController;
use App\Http\Controllers\dashboard\ShippingRateCardController;
use App\Http\Controllers\dashboard\ShippingRateController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\WebArController;
use App\Http\Controllers\WebEnController;
use App\Http\Controllers\ShippingQuoteController;
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
Route::get('profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile', [AuthController::class, 'update'])->name('profile.update');
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::get('/', [homeController::class, 'home'])->name('home');

// Shipping Quote Routes (calculate requires login)
Route::get('/shipping-rates', [ShippingQuoteController::class, 'showPage'])->name('shipping.rates.page');
Route::post('/shipping/quote', [ShippingQuoteController::class, 'calculate'])->name('shipping.quote')->middleware('auth');
Route::get('/shipping/countries', [ShippingQuoteController::class, 'countries'])->name('shipping.countries');

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'dashboard'], function () {

    Route::get('/', [homeController::class, 'index'])->name('home.dashboard');

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

    //this route notifications
    Route::resource('notifications', NotificationController::class);

    Route::resource('web-ens', WebEnController::class);
    Route::resource('web-ars', WebArController::class);

    // Shipping Pricing Management
    Route::resource('countries', CountryController::class)->names([
        'index' => 'dashboard.countries.index',
        'store' => 'dashboard.countries.store',
        'update' => 'dashboard.countries.update',
        'destroy' => 'dashboard.countries.destroy',
    ]);

    Route::resource('shipping-zones', ShippingZoneController::class)->names([
        'index' => 'dashboard.shipping-zones.index',
        'store' => 'dashboard.shipping-zones.store',
        'update' => 'dashboard.shipping-zones.update',
        'destroy' => 'dashboard.shipping-zones.destroy',
    ]);
    Route::post('shipping-zones/{shippingZone}/assign-countries', [ShippingZoneController::class, 'assignCountries'])
        ->name('dashboard.shipping-zones.assign-countries');

    Route::resource('shipping-rate-cards', ShippingRateCardController::class)->names([
        'index' => 'dashboard.shipping-rate-cards.index',
        'store' => 'dashboard.shipping-rate-cards.store',
        'update' => 'dashboard.shipping-rate-cards.update',
        'destroy' => 'dashboard.shipping-rate-cards.destroy',
    ]);

    Route::get('shipping-rate-cards/{shippingRateCard}/rates', [ShippingRateController::class, 'index'])
        ->name('dashboard.shipping-rates.index');
    Route::post('shipping-rate-cards/{shippingRateCard}/rates', [ShippingRateController::class, 'store'])
        ->name('dashboard.shipping-rates.store');
    Route::put('shipping-rate-cards/{shippingRateCard}/rates/{shippingRate}', [ShippingRateController::class, 'update'])
        ->name('dashboard.shipping-rates.update');
    Route::delete('shipping-rate-cards/{shippingRateCard}/rates/{shippingRate}', [ShippingRateController::class, 'destroy'])
        ->name('dashboard.shipping-rates.destroy');

});

Route::get('locale/{lang}', function ($lang) {
    App::setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->back();
})->name('locale');
