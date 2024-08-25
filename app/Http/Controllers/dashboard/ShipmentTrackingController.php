<?php

namespace App\Http\Controllers\dashboard;

use App\Events\ContainerLocationUpdated;
use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\ShipmentTracking;
use Illuminate\Http\Request;

class ShipmentTrackingController extends Controller
{
    public function index()
    {
        $shipmentTrackings = ShipmentTracking::with('container', 'location')->paginate(10);
        return view('dashboard.shipment_trackings.index', compact('shipmentTrackings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'container_id' => 'required|exists:containers,id',
            'location_id' => 'required|exists:locations,id',
            'delivered_date' => 'nullable|date',
            'expected_arrival_date' => 'nullable|date',
        ]);

        $container = Container::find($request->container_id);

        event(new ContainerLocationUpdated($container));

        ShipmentTracking::create($request->all());

        return redirect()->route('shipment_trackings.index')->with('success', 'Shipment tracking record created successfully.');
    }

    public function update(Request $request, ShipmentTracking $shipmentTracking)
    {
        $request->validate([
            'container_id' => 'required|exists:containers,id',
            'location_id' => 'required|exists:locations,id',
            'delivered_date' => 'nullable|date',
            'expected_arrival_date' => 'nullable|date',
        ]);

        $shipmentTracking->update($request->all());

        return redirect()->route('shipment_trackings.index')->with('success', 'Shipment tracking record updated successfully.');
    }

    public function destroy(ShipmentTracking $shipmentTracking)
    {
        $shipmentTracking->delete();
        return redirect()->route('shipment_trackings.index')->with('success', 'Shipment tracking record deleted successfully.');
    }
}
