<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingZone;
use App\Models\ShippingZoneCountry;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    public function index()
    {
        $jordan = Country::where('name_en', 'Jordan')->first();
        $zones = ShippingZone::where('origin_country_id', $jordan->id ?? 0)
            ->with('originCountry')
            ->orderBy('code')
            ->get();
        $countries = Country::where('is_active', true)->orderBy('name_en')->get();

        return view('dashboard.shipping-zones.index', compact('zones', 'countries', 'jordan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origin_country_id' => 'required|exists:countries,id',
            'code' => 'required|string|max:10',
            'name' => 'nullable|string|max:255',
        ]);

        ShippingZone::create($validated);
        return redirect()->route('dashboard.shipping-zones.index')
            ->with('success', 'تم إضافة المنطقة بنجاح.');
    }

    public function update(Request $request, ShippingZone $shippingZone)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10',
            'name' => 'nullable|string|max:255',
        ]);

        $shippingZone->update($validated);
        return redirect()->route('dashboard.shipping-zones.index')
            ->with('success', 'تم تحديث المنطقة بنجاح.');
    }

    public function assignCountries(Request $request, ShippingZone $shippingZone)
    {
        $validated = $request->validate([
            'country_ids' => 'required|array',
            'country_ids.*' => 'exists:countries,id',
        ]);

        // Delete existing mappings for this zone
        ShippingZoneCountry::where('shipping_zone_id', $shippingZone->id)
            ->where('origin_country_id', $shippingZone->origin_country_id)
            ->delete();

        // Create new mappings
        foreach ($validated['country_ids'] as $countryId) {
            ShippingZoneCountry::create([
                'origin_country_id' => $shippingZone->origin_country_id,
                'destination_country_id' => $countryId,
                'shipping_zone_id' => $shippingZone->id,
            ]);
        }

        return redirect()->route('dashboard.shipping-zones.index')
            ->with('success', 'تم ربط الدول بالمنطقة بنجاح.');
    }

    public function destroy(ShippingZone $shippingZone)
    {
        $shippingZone->delete();
        return redirect()->route('dashboard.shipping-zones.index')
            ->with('success', 'تم حذف المنطقة بنجاح.');
    }
}
