<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Container;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index()
    {
        $containers = Container::paginate(10);
        return view('dashboard.containers.index', compact('containers'));
    }

    public function containerShipments($container_id)
    {
        $container = Container::findOrFail($container_id);
        $shipments = Shipment::where('container_id', $container->id)->paginate(10);
        return view('dashboard.containers.shipments', compact('container', 'shipments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'container_number' => 'required|unique:containers,container_number',
            'size' => 'required|in:20,40,45,20HC,40HC,45HC',
            'notes' => 'nullable|string',
        ]);

        Container::create($request->all());

        return redirect()->route('containers.index')->with('success', 'Container created successfully.');
    }

    public function update(Request $request, Container $container)
    {
        $request->validate([
            'container_number' => 'required|unique:containers,container_number,' . $container->id,
            'size' => 'required|in:20,40,45,20HC,40HC,45HC',
            'notes' => 'nullable|string',
        ]);

        $container->update($request->all());

        return redirect()->route('containers.index')->with('success', 'Container updated successfully.');
    }

    public function destroy(Container $container)
    {
        $container->delete();

        return redirect()->route('containers.index')->with('success', 'Container deleted successfully.');
    }
}
