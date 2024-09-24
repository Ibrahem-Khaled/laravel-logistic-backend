<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Sliders;
use App\Models\Notfication;
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

        $modifiedShipments = $shipments->map(function ($shipment) {
            $location = $shipment->container->location->last();

            if ($location && !is_null($location->pivot->expected_arrival_date)) {
                $shipment->delivered_date = $location->pivot->expected_arrival_date;
            }

            return $shipment;
        });

        return response()->json($modifiedShipments, 200);
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
        $modifiedShipments = $shipments->map(function ($shipment) {
            $location = $shipment->container->location->last();

            if ($location && !is_null($location->pivot->expected_arrival_date)) {
                $shipment->delivered_date = $location->pivot->expected_arrival_date;
            }

            return $shipment;
        });

        return response()->json($modifiedShipments, 200);
    }


    public function shipment($shipmentId)
    {
        // جلب الشحنة مع البيانات المرتبطة بالحاوية والموقع
        $shipment = Shipment::with('container.location')->find($shipmentId);

        // التحقق من وجود الشحنة
        if (!$shipment) {
            return response()->json('Shipment not found.', 404);
        }

        // التحقق من وجود الحاوية والموقع
        if ($shipment->container && $shipment->container->location->isNotEmpty()) {
            // جلب الموقع الأخير من مواقع الحاوية
            $lastLocation = $shipment->container->location->last();

            // التحقق من وجود الموقع وتاريخ الوصول المتوقع
            if ($lastLocation && !is_null($lastLocation->pivot->expected_arrival_date)) {
                // تعديل تاريخ الإنشاء ليكون تاريخ الوصول المتوقع
                $shipment->created_at = $lastLocation->pivot->expected_arrival_date;
            }
        }

        // إعادة الشحنة بعد التعديل
        return response()->json($shipment, 200);
    }

    public function search(Request $request)
    {
        $q = $request->search;
        if (empty($q)) {
            return response()->json('Search field is required.', 400);
        }

        $shipment = Shipment::with(['user', 'container.location'])->where('tracking_number', $q)->first();

        if (!$shipment) {
            return response()->json('Shipment not found.', 404);
        }

        $location = $shipment->container->location->last();

        if ($location && !is_null($location->pivot->expected_arrival_date)) {
            $shipment->delivered_date = $location->pivot->expected_arrival_date;
        }

        return response()->json($shipment, 200);
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

    public function notificatins()
    {
        $user = auth()->guard('api')->user();
        $userNotifications = Notfication::where('user_id', $user->id)
        ->orWhereNull('user_id')
        ->sortedByDesc('created_at')
        ->get();

        $user->notifications()->where('is_read', 0)->update(['is_read' => 1]);
        return response()->json($userNotifications, 200);
    }
}
