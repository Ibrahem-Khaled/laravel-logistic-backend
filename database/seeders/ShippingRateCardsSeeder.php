<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingRateCard;
use Illuminate\Database\Seeder;

class ShippingRateCardsSeeder extends Seeder
{
    public function run(): void
    {
        $jordan = Country::where('name_en', 'Jordan')->first();

        if (!$jordan) {
            $this->command->error('Jordan country not found.');
            return;
        }

        // Create Rate Card for Parcel
        ShippingRateCard::firstOrCreate(
            [
                'origin_country_id' => $jordan->id,
                'shipment_type' => 'parcel',
            ],
            [
                'name' => 'KAFAFI Parcel Rate Card 2024',
                'currency' => 'JOD',
                'is_active' => true,
                'valid_from' => now()->startOfYear(),
                'valid_to' => now()->endOfYear(),
            ]
        );

        // Create Rate Card for Documents
        ShippingRateCard::firstOrCreate(
            [
                'origin_country_id' => $jordan->id,
                'shipment_type' => 'documents',
            ],
            [
                'name' => 'KAFAFI Documents Rate Card 2024',
                'currency' => 'JOD',
                'is_active' => true,
                'valid_from' => now()->startOfYear(),
                'valid_to' => now()->endOfYear(),
            ]
        );
    }
}
