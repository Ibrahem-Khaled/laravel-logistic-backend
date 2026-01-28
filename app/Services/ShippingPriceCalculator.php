<?php

namespace App\Services;

use App\Models\Country;
use App\Models\ShippingRate;
use App\Models\ShippingRateCard;
use App\Models\ShippingZone;
use App\Models\ShippingZoneCountry;
use Illuminate\Support\Facades\DB;

class ShippingPriceCalculator
{
    /**
     * Calculate shipping price
     *
     * @param int $originCountryId
     * @param int $destinationCountryId
     * @param string $shipmentType 'documents' or 'parcel'
     * @param float $weightPerUnit Weight per unit in the specified unit
     * @param int $unitsCount Number of units
     * @param string $weightUnit 'kg' or 'lb'
     * @return array
     */
    public function calculate(
        int $originCountryId,
        int $destinationCountryId,
        string $shipmentType,
        float $weightPerUnit,
        int $unitsCount,
        string $weightUnit = 'kg'
    ): array {
        // Convert weight to kg if needed
        $weightPerUnitKg = $weightUnit === 'lb' ? $weightPerUnit / 2.20462 : $weightPerUnit;
        $totalWeightKg = $weightPerUnitKg * $unitsCount;

        // Find zone mapping
        $zoneMapping = ShippingZoneCountry::where('origin_country_id', $originCountryId)
            ->where('destination_country_id', $destinationCountryId)
            ->with('zone')
            ->first();

        if (!$zoneMapping) {
            return [
                'success' => false,
                'message' => 'No shipping zone found for this route.',
                'price' => null,
            ];
        }

        $zone = $zoneMapping->zone;

        // Find active rate card
        $rateCard = ShippingRateCard::where('origin_country_id', $originCountryId)
            ->where('shipment_type', $shipmentType)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('valid_from')
                    ->orWhere('valid_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('valid_to')
                    ->orWhere('valid_to', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$rateCard) {
            return [
                'success' => false,
                'message' => 'No active rate card found for this shipment type.',
                'price' => null,
            ];
        }

        // Find applicable rate
        $rate = $this->findApplicableRate($rateCard->id, $zone->id, $totalWeightKg);

        if (!$rate) {
            return [
                'success' => false,
                'message' => 'No rate found for this weight range.',
                'price' => null,
            ];
        }

        // Calculate price
        if ($rate->pricing_type === 'flat') {
            $finalPrice = $rate->price;
        } else {
            // per_kg
            $finalPrice = $totalWeightKg * $rate->price_per_kg;
        }

        return [
            'success' => true,
            'price' => round($finalPrice, 2),
            'currency' => $rateCard->currency,
            'breakdown' => [
                'origin_country' => Country::find($originCountryId)->name_en,
                'destination_country' => Country::find($destinationCountryId)->name_en,
                'zone' => $zone->code,
                'shipment_type' => $shipmentType,
                'weight_per_unit' => round($weightPerUnitKg, 2) . ' kg',
                'units_count' => $unitsCount,
                'total_weight' => round($totalWeightKg, 2) . ' kg',
                'pricing_type' => $rate->pricing_type,
                'rate_applied' => $rate->pricing_type === 'flat'
                    ? $rate->price
                    : ($rate->price_per_kg . ' per kg'),
                'weight_range' => $rate->weight_from_kg . ' - ' . ($rate->weight_to_kg >= 9999 ? '∞' : $rate->weight_to_kg) . ' kg',
            ],
        ];
    }

    /**
     * Find applicable rate for weight
     */
    private function findApplicableRate(int $rateCardId, int $zoneId, float $totalWeightKg): ?ShippingRate
    {
        // First, try to find flat rate that matches exact weight or covers it
        $flatRate = ShippingRate::where('shipping_rate_card_id', $rateCardId)
            ->where('shipping_zone_id', $zoneId)
            ->where('pricing_type', 'flat')
            ->where('weight_from_kg', '<=', $totalWeightKg)
            ->where('weight_to_kg', '>=', $totalWeightKg)
            ->orderBy('weight_from_kg', 'desc')
            ->first();

        if ($flatRate) {
            return $flatRate;
        }

        // If no flat rate, find per_kg rate
        $perKgRate = ShippingRate::where('shipping_rate_card_id', $rateCardId)
            ->where('shipping_zone_id', $zoneId)
            ->where('pricing_type', 'per_kg')
            ->where('weight_from_kg', '<=', $totalWeightKg)
            ->where('weight_to_kg', '>=', $totalWeightKg)
            ->orderBy('weight_from_kg', 'asc')
            ->first();

        return $perKgRate;
    }
}
