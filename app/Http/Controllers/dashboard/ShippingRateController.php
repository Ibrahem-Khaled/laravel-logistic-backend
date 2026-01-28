<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ShippingRate;
use App\Models\ShippingRateCard;
use App\Models\ShippingZone;
use Illuminate\Http\Request;

class ShippingRateController extends Controller
{
    public function index(ShippingRateCard $shippingRateCard)
    {
        $zones = ShippingZone::where('origin_country_id', $shippingRateCard->origin_country_id)
            ->orderBy('code')
            ->get();

        $rates = ShippingRate::where('shipping_rate_card_id', $shippingRateCard->id)
            ->with('zone')
            ->orderBy('shipping_zone_id')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('shipping_zone_id');

        return view('dashboard.shipping-rates.index', compact('shippingRateCard', 'zones', 'rates'));
    }

    public function store(Request $request, ShippingRateCard $shippingRateCard)
    {
        $validated = $request->validate([
            'shipping_zone_id' => 'required|exists:shipping_zones,id',
            'pricing_type' => 'required|in:flat,per_kg',
            'weight_from_kg' => 'required|numeric|min:0',
            'weight_to_kg' => 'required|numeric|min:0|gte:weight_from_kg',
            'price' => 'nullable|numeric|min:0|required_if:pricing_type,flat',
            'price_per_kg' => 'nullable|numeric|min:0|required_if:pricing_type,per_kg',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['shipping_rate_card_id'] = $shippingRateCard->id;
        ShippingRate::create($validated);

        return redirect()->route('dashboard.shipping-rates.index', $shippingRateCard->id)
            ->with('success', 'تم إضافة السعر بنجاح.');
    }

    public function update(Request $request, ShippingRateCard $shippingRateCard, ShippingRate $shippingRate)
    {
        $validated = $request->validate([
            'pricing_type' => 'required|in:flat,per_kg',
            'weight_from_kg' => 'required|numeric|min:0',
            'weight_to_kg' => 'required|numeric|min:0|gte:weight_from_kg',
            'price' => 'nullable|numeric|min:0|required_if:pricing_type,flat',
            'price_per_kg' => 'nullable|numeric|min:0|required_if:pricing_type,per_kg',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $shippingRate->update($validated);

        return redirect()->route('dashboard.shipping-rates.index', $shippingRateCard->id)
            ->with('success', 'تم تحديث السعر بنجاح.');
    }

    public function destroy(ShippingRateCard $shippingRateCard, ShippingRate $shippingRate)
    {
        $shippingRate->delete();
        return redirect()->route('dashboard.shipping-rates.index', $shippingRateCard->id)
            ->with('success', 'تم حذف السعر بنجاح.');
    }
}
