<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryLocation;

class DeliveryLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $delivery_locations = [
            'Nairobi City',
            'Waiyaki Way',
            'Kiambu Road',
            'Ngong Road',
            'Langata Road',
            'Lower Kabete Road',
            'Limuru Road',
            'Thika Road',
            'Kilimani',
            'Mombasa Road',
            'Jogoo Road',
        ];

        foreach($delivery_locations as $delivery_location) {
            DeliveryLocation::create([
                'location_name' => $delivery_location
            ]);
        }
    }
}
