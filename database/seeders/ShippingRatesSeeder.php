<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingRate;
use App\Models\ShippingRateCard;
use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingRatesSeeder extends Seeder
{
    public function run(): void
    {
        $jordan = Country::where('name_en', 'Jordan')->first();

        if (!$jordan) {
            $this->command->error('Jordan country not found.');
            return;
        }

        // Get zones
        $zones = ShippingZone::where('origin_country_id', $jordan->id)
            ->orderBy('code')
            ->get()
            ->keyBy('code');

        // Get rate cards
        $parcelCard = ShippingRateCard::where('origin_country_id', $jordan->id)
            ->where('shipment_type', 'parcel')
            ->first();

        $documentsCard = ShippingRateCard::where('origin_country_id', $jordan->id)
            ->where('shipment_type', 'documents')
            ->first();

        if (!$parcelCard || !$documentsCard) {
            $this->command->error('Rate cards not found. Please run ShippingRateCardsSeeder first.');
            return;
        }

        // Flat rates for weights 0.5 to 14 kg (from PDF)
        $flatRates = [
            ['weight' => 0.5, 'zones' => [17, 20, 20, 25, 30, 30]],
            ['weight' => 1, 'zones' => [23, 25, 25, 30, 35, 35]],
            ['weight' => 1.5, 'zones' => [29, 30, 30, 37, 40, 40]],
            ['weight' => 2, 'zones' => [30, 35, 35, 40, 45, 55]],
            ['weight' => 2.5, 'zones' => [40, 40, 45, 50, 55, 55]],
            ['weight' => 3, 'zones' => [45, 45, 50, 55, 60, 60]],
            ['weight' => 3.5, 'zones' => [45, 45, 55, 60, 64, 64]],
            ['weight' => 4, 'zones' => [50, 50, 60, 65, 70, 70]],
            ['weight' => 4.5, 'zones' => [55, 55, 65, 70, 75, 75]],
            ['weight' => 5, 'zones' => [60, 60, 70, 75, 80, 80]],
            ['weight' => 5.5, 'zones' => [65, 65, 75, 80, 85, 85]],
            ['weight' => 6, 'zones' => [70, 70, 80, 85, 90, 90]],
            ['weight' => 6.5, 'zones' => [75, 75, 85, 90, 95, 95]],
            ['weight' => 7, 'zones' => [80, 80, 90, 95, 100, 100]],
            ['weight' => 7.5, 'zones' => [85, 85, 95, 100, 105, 105]],
            ['weight' => 8, 'zones' => [90, 90, 100, 105, 110, 110]],
            ['weight' => 8.5, 'zones' => [95, 95, 105, 110, 115, 115]],
            ['weight' => 9, 'zones' => [100, 100, 110, 115, 120, 120]],
            ['weight' => 9.5, 'zones' => [105, 105, 115, 120, 125, 125]],
            ['weight' => 10, 'zones' => [110, 110, 120, 125, 130, 130]],
            ['weight' => 10.5, 'zones' => [115, 115, 125, 130, 135, 135]],
            ['weight' => 11, 'zones' => [120, 120, 130, 135, 140, 140]],
            ['weight' => 11.5, 'zones' => [125, 125, 135, 140, 145, 145]],
            ['weight' => 12, 'zones' => [130, 130, 140, 145, 150, 150]],
            ['weight' => 12.5, 'zones' => [135, 135, 145, 150, 155, 155]],
            ['weight' => 13, 'zones' => [140, 140, 150, 155, 160, 160]],
            ['weight' => 13.5, 'zones' => [145, 145, 155, 160, 165, 165]],
            ['weight' => 14, 'zones' => [150, 150, 160, 165, 170, 170]],
        ];

        $zoneCodes = ['Z1', 'Z2', 'Z3', 'Z4', 'Z5', 'Z6'];
        $sortOrder = 0;

        // Insert flat rates for both parcel and documents (same rates)
        foreach ([$parcelCard, $documentsCard] as $rateCard) {
            foreach ($flatRates as $rate) {
                foreach ($zoneCodes as $index => $zoneCode) {
                    $zone = $zones[$zoneCode] ?? null;
                    if (!$zone) continue;

                    ShippingRate::firstOrCreate(
                        [
                            'shipping_rate_card_id' => $rateCard->id,
                            'shipping_zone_id' => $zone->id,
                            'weight_from_kg' => $rate['weight'],
                            'weight_to_kg' => $rate['weight'],
                        ],
                        [
                            'pricing_type' => 'flat',
                            'price' => $rate['zones'][$index],
                            'sort_order' => $sortOrder++,
                        ]
                    );
                }
            }
        }

        // Per-kg rates for weight ranges
        $perKgRates = [
            ['from' => 15, 'to' => 29, 'zones' => [7, 7, 10, 12, 14, 15]],
            ['from' => 30, 'to' => 49, 'zones' => [6.5, 6.5, 9, 11, 14, 15]],
            ['from' => 50, 'to' => 9999, 'zones' => [6, 6.5, 8.5, 11, 14, 15]], // 9999 as max
        ];

        foreach ([$parcelCard, $documentsCard] as $rateCard) {
            foreach ($perKgRates as $rate) {
                foreach ($zoneCodes as $index => $zoneCode) {
                    $zone = $zones[$zoneCode] ?? null;
                    if (!$zone) continue;

                    ShippingRate::firstOrCreate(
                        [
                            'shipping_rate_card_id' => $rateCard->id,
                            'shipping_zone_id' => $zone->id,
                            'weight_from_kg' => $rate['from'],
                            'weight_to_kg' => $rate['to'],
                        ],
                        [
                            'pricing_type' => 'per_kg',
                            'price_per_kg' => $rate['zones'][$index],
                            'sort_order' => $sortOrder++,
                        ]
                    );
                }
            }
        }
    }
}
