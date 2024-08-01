<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function userShipments()
    {
        $user = auth()->guard('api')->user();
        $shipments = $user->shipments()->with('location')->get();
        return response()->json($shipments, 200);
    }

    public function search(Request $request)
    {
        $q = $request->search;
        if (empty($q)) {
            return response()->json('Search field is required.', 400);
        }
        $shipments = Shipment::with('user', 'container', 'location')->where('tracking_number', $q)->first();
        if (!$shipments) {
            return response()->json('Shipment not found.', 404);
        }
        return response()->json($shipments, 200);
    }

    public function pendingShipments()
    {
        $user = auth()->guard('api')->user();
        $shipments = $user->shipments()->with('location')->where('status', 'pending')->get();
        if ($shipments->count() == 0) {
            return response()->json('No pending shipment found.', 404);
        }
        return response()->json($shipments, 200);
    }

    public function deliveredShipments()
    {
        $user = auth()->guard('api')->user();
        $shipments = $user->shipments()->with('location')->where('status', 'delivered')->get();
        if ($shipments->count() == 0) {
            return response()->json('No delivered shipment found.', 404);
        }
        return response()->json($shipments, 200);
    }
}
