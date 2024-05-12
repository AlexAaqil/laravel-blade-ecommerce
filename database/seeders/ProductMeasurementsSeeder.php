<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductMeasurement;

class ProductMeasurementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurements = [
            'kg',
            'g',
            'L',
            'ml',
        ];

        foreach($measurements as $measurement) {
            ProductMeasurement::create([
                'measurement_name' => $measurement
            ]);
        }
    }
}
