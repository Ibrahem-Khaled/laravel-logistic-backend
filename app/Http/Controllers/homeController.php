<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Shipment;
use App\Models\User;
use App\Models\WebAr;
use App\Models\WebEn;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalShipments = Shipment::count();
        $recentActivities = []; // يمكنك استبدالها بالأنشطة الحقيقية

        return view('dashboard.index', compact('totalUsers', 'totalShipments', 'recentActivities'));
    }

    public function home()
    {
        $clients = User::whereIn('role', ['company', 'user', 'driver', 'manager', 'company'])->get();
        $web = session()->get('locale') == 'ar'
            ? (WebAr::first() ?? new WebAr())
            : (WebEn::first() ?? new WebEn());
        $jordan = Country::where('name_en', 'Jordan')->first();
        return view('home', compact('clients', 'web', 'jordan'));
    }
}
