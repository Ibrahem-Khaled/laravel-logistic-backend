<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with('user', 'container.location')->paginate(10);

        $modifiedShipments = $shipments->getCollection()->map(function ($shipment) {
            $location = $shipment->container->location->last();

            if ($location && !is_null($location->pivot->expected_arrival_date)) {
                $shipment->delivered_date = $location->pivot->expected_arrival_date;
            }

            return $shipment;
        });
        $shipments->setCollection($modifiedShipments);
        // return response()->json($shipments);
        return view('dashboard.shipments.index', compact('shipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'container_id' => 'required|exists:containers,id',
            'type' => 'required|in:aerial,ground,nautical',
            'tracking_number' => 'required|string|unique:shipments,tracking_number|max:50',
            'sent_area' => 'required|string|max:255',
            'delivered_area' => 'required|string|max:255',
            'sent_date' => 'nullable|date',
            'delivered_date' => 'nullable|date',
            'weight' => 'required|integer',
            'dimensions' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'shipment_count' => 'required|integer|min:0',
        ]);

        Shipment::create($request->all());

        return redirect()->route('shipments.index')->with('success', 'تم إضافة الشحنة بنجاح.');
    }
    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'container_id' => 'required|exists:containers,id',
            'type' => 'required|in:aerial,ground,nautical',
            'tracking_number' => 'required|string|unique:shipments,tracking_number,' . $shipment->id . '|max:50',
            'sent_area' => 'required|string|max:255',
            'delivered_area' => 'required|string|max:255',
            'sent_date' => 'nullable|date',
            'delivered_date' => 'nullable|date',
            'weight' => 'required|integer',
            'dimensions' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'shipment_count' => 'required|integer|min:0',
        ]);

        $shipment->update($request->all());

        return redirect()->route('shipments.index')->with('success', 'تم تحديث الشحنة بنجاح.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully.');
    }
}
