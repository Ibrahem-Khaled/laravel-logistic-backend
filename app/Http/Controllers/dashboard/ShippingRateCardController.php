<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingRateCard;
use Illuminate\Http\Request;

class ShippingRateCardController extends Controller
{
    public function index()
    {
        $jordan = Country::where('name_en', 'Jordan')->first();
        $countries = Country::where('is_active', true)
            ->orderBy('name_en')
            ->get();
        $rateCards = ShippingRateCard::with('originCountry')
            ->orderBy('origin_country_id')
            ->orderBy('shipment_type')
            ->get();

        return view('dashboard.shipping-rate-cards.index', compact('rateCards', 'jordan', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origin_country_id' => 'required|exists:countries,id',
            'shipment_type' => 'required|in:documents,parcel',
            'name' => 'nullable|string|max:255',
            'currency' => 'required|string|size:3',
            'is_active' => 'boolean',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
        ]);

        ShippingRateCard::create($validated);
        return redirect()->route('dashboard.shipping-rate-cards.index')
            ->with('success', 'تم إضافة جدول التسعير بنجاح.');
    }

    public function update(Request $request, ShippingRateCard $shippingRateCard)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'currency' => 'required|string|size:3',
            'is_active' => 'boolean',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
        ]);

        $shippingRateCard->update($validated);
        return redirect()->route('dashboard.shipping-rate-cards.index')
            ->with('success', 'تم تحديث جدول التسعير بنجاح.');
    }

    public function destroy(ShippingRateCard $shippingRateCard)
    {
        $shippingRateCard->delete();
        return redirect()->route('dashboard.shipping-rate-cards.index')
            ->with('success', 'تم حذف جدول التسعير بنجاح.');
    }
}
