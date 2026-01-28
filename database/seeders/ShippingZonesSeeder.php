<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingZonesSeeder extends Seeder
{
    public function run(): void
    {
        $jordan = Country::where('name_en', 'Jordan')->first();

        if (!$jordan) {
            $this->command->error('Jordan country not found. Please run CountriesSeeder first.');
            return;
        }

        $zones = [
            ['code' => 'Z1', 'name' => 'Zone 1'],
            ['code' => 'Z2', 'name' => 'Zone 2'],
            ['code' => 'Z3', 'name' => 'Zone 3'],
            ['code' => 'Z4', 'name' => 'Zone 4'],
            ['code' => 'Z5', 'name' => 'Zone 5'],
            ['code' => 'Z6', 'name' => 'Zone 6'],
        ];

        foreach ($zones as $zone) {
            ShippingZone::firstOrCreate(
                [
                    'origin_country_id' => $jordan->id,
                    'code' => $zone['code'],
                ],
                [
                    'name' => $zone['name'],
                ]
            );
        }
    }
}
