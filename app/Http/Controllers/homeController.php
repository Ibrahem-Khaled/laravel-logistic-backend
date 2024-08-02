<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalShipments = Shipment::count();
        $recentActivities = []; // يمكنك استبدالها بالأنشطة الحقيقية

        return view('home', compact('totalUsers', 'totalShipments', 'recentActivities'));
    }
}
