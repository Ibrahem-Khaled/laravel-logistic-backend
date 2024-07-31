<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with('user', 'container')->paginate(10);
        return view('dashboard.shipments.index', compact('shipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'container_id' => 'required|exists:containers,id',
            'status' => 'required|in:pending,in_transit,delivered,failed',
            'tracking_number' => 'nullable|string|unique:shipments,tracking_number',
            'sent_date' => 'nullable|date',
            'delivered_date' => 'nullable|date',
            'weight' => 'nullable|integer',
            'dimensions' => 'nullable|string',
        ]);

        Shipment::create($request->all());

        return redirect()->route('shipments.index')->with('success', 'Shipment created successfully.');
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'container_id' => 'required|exists:containers,id',
            'status' => 'required|in:pending,in_transit,delivered,failed',
            'tracking_number' => 'nullable|string|unique:shipments,tracking_number,' . $shipment->id,
            'sent_date' => 'nullable|date',
            'delivered_date' => 'nullable|date',
            'weight' => 'nullable|integer',
            'dimensions' => 'nullable|string',
        ]);

        $shipment->update($request->all());

        return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully.');
    }
}
