<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\ShippingPriceCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingQuoteController extends Controller
{
    protected ShippingPriceCalculator $calculator;

    public function __construct(ShippingPriceCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * Calculate shipping quote
     */
    public function calculate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'origin_country_id' => 'required|exists:countries,id',
            'destination_country_id' => 'required|exists:countries,id',
            'shipment_type' => 'required|in:documents,parcel',
            'weight_per_unit' => 'required|numeric|min:0.01',
            'units_count' => 'required|integer|min:1',
            'weight_unit' => 'required|in:kg,lb',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $result = $this->calculator->calculate(
            $request->origin_country_id,
            $request->destination_country_id,
            $request->shipment_type,
            $request->weight_per_unit,
            $request->units_count,
            $request->weight_unit
        );

        return response()->json($result, $result['success'] ? 200 : 404);
    }

    /**
     * Get active countries list
     */
    public function countries(): JsonResponse
    {
        $countries = Country::where('is_active', true)
            ->orderBy('name_en')
            ->get(['id', 'name_en', 'name_ar', 'iso2']);

        return response()->json([
            'success' => true,
            'countries' => $countries,
        ]);
    }
}
