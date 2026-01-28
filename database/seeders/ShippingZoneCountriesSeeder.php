<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingZone;
use App\Models\ShippingZoneCountry;
use Illuminate\Database\Seeder;

class ShippingZoneCountriesSeeder extends Seeder
{
    public function run(): void
    {
        $jordan = Country::where('name_en', 'Jordan')->first();

        if (!$jordan) {
            $this->command->error('Jordan country not found.');
            return;
        }

        // Zone mapping from PDF
        $zoneMapping = [
            'Z1' => ['Qatar', 'Saudi Arabia', 'Bahrain', 'Kuwait', 'United Arab Emirates', 'Oman'],
            'Z2' => [
                'Finland', 'France', 'Germany', 'Greece', 'Hungary', 'India', 'Ireland', 'Italy',
                'Netherlands', 'Norway', 'Poland', 'Portugal', 'Romania', 'Spain', 'Sweden',
                'Switzerland', 'Taiwan', 'United Kingdom', 'Bangladesh', 'Czech Republic',
                'Denmark', 'Egypt', 'China', 'Austria', 'Belgium', 'Lebanon', 'Sri Lanka',
                'Hong Kong', 'Pakistan'
            ],
            'Z3' => [
                'Afghanistan', 'Indonesia', 'Singapore', 'Japan', 'South Korea', 'Kenya',
                'Thailand', 'Vietnam', 'Malaysia', 'Canada'
            ],
            'Z4' => [
                'Australia', 'Iceland', 'Brazil', 'United States', 'South Africa',
                'Luxembourg', 'Cyprus'
            ],
            'Z5' => [
                'Albania', 'Algeria', 'Angola', 'Argentina', 'Armenia', 'Belarus', 'Benin',
                'Bolivia', 'Bulgaria', 'Burkina Faso', 'Croatia', 'Malta', 'Morocco',
                'Tunisia', 'Turkey', 'Ukraine', 'Iraq', 'Estonia', 'Lithuania', 'Serbia',
                'Slovakia', 'Slovenia', 'Mexico', 'San Marino'
            ],
            'Z6' => [], // Rest of the World - will be handled separately
        ];

        foreach ($zoneMapping as $zoneCode => $countryNames) {
            $zone = ShippingZone::where('origin_country_id', $jordan->id)
                ->where('code', $zoneCode)
                ->first();

            if (!$zone) {
                $this->command->warn("Zone {$zoneCode} not found. Skipping.");
                continue;
            }

            foreach ($countryNames as $countryName) {
                $country = Country::where('name_en', $countryName)->first();

                if ($country) {
                    ShippingZoneCountry::firstOrCreate(
                        [
                            'origin_country_id' => $jordan->id,
                            'destination_country_id' => $country->id,
                        ],
                        [
                            'shipping_zone_id' => $zone->id,
                        ]
                    );
                } else {
                    $this->command->warn("Country {$countryName} not found. Skipping.");
                }
            }
        }
    }
}
