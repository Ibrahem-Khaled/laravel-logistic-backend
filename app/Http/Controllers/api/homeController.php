<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Sliders;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function userShipments()
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $shipments = $user->shipments()
            ->with(['container.location'])
            ->take(5)
            ->get();

        return response()->json($shipments, 200);
    }

    public function allShipment()
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $shipments = $user->shipments()->with('container.location')->get();
        if ($shipments->count() == 0) {
            return response()->json('No shipment found.', 404);
        }
        return response()->json($shipments, 200);
    }


    public function shipment($shipmentId)
    {
        $shipment = Shipment::with('container.location')->find($shipmentId);
        if (!$shipment) {
            return response()->json('Shipment not found.', 404);
        }
        return response()->json($shipment, 200);
    }

    public function search(Request $request)
    {
        $q = $request->search;
        if (empty($q)) {
            return response()->json('Search field is required.', 400);
        }
        $shipments = Shipment::with('user', 'container.location')->where('tracking_number', $q)->first();
        if (!$shipments) {
            return response()->json('Shipment not found.', 404);
        }
        return response()->json($shipments, 200);
    }

    public function pendingShipments()
    {
        $user = auth()->guard('api')->user();
        $shipments = $user->shipments()->with('container.location')->where('status', 'pending')->get();
        if ($shipments->count() == 0) {
            return response()->json('No pending shipment found.', 404);
        }
        return response()->json($shipments, 200);
    }

    public function deliveredShipments()
    {
        $user = auth()->guard('api')->user();
        $shipments = $user->shipments()->with('container.location')->where('status', 'delivered')->get();
        if ($shipments->count() == 0) {
            return response()->json('No delivered shipment found.', 404);
        }
        return response()->json($shipments, 200);
    }

    public function slides()
    {
        $slides = Sliders::all();
        if ($slides->count() == 0) {
            return response()->json('No slides found.', 404);
        }
        return response()->json($slides, 200);
    }
}
