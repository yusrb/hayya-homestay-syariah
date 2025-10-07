<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Seed package data for Glamping Hayya.
     */
    public function run(): void
    {
        // Define sample package data
        $packages = [
            [
                'name' => 'Standard Glamping Package',
                'price' => 750000,
                'duration' => '1 night',
                'description' => 'Enjoy a relaxing stay in our glamping villa with breakfast for 3 persons.',
                'features' => [
                    'King Size Bed',
                    'Private Bathroom with Hot Water',
                    'Smart TV',
                    'WiFi',
                    'Breakfast for 3',
                    'Mountain and Sunset Views',
                ],
                'image_url' => 'images/packages/standard_glamping.jpg',
                'is_popular' => true,
            ],
            [
                'name' => 'Adventure Package',
                'price' => 1200000,
                'duration' => '1 night',
                'description' => 'Includes glamping stay and Jeep Adventure tour.',
                'features' => [
                    'King Size Bed',
                    'Private Bathroom with Hot Water',
                    'Smart TV',
                    'WiFi',
                    'Breakfast for 3',
                    'Jeep Adventure Tour',
                    'Mountain and Sunset Views',
                ],
                'image_url' => 'images/packages/adventure_package.jpg',
                'is_popular' => false,
            ],
            [
                'name' => 'BBQ Grill Package',
                'price' => 950000,
                'duration' => '1 night',
                'description' => 'Glamping stay with BBQ grill experience.',
                'features' => [
                    'King Size Bed',
                    'Private Bathroom with Hot Water',
                    'Smart TV',
                    'WiFi',
                    'Breakfast for 3',
                    'BBQ Grill Setup',
                    'Mountain and Sunset Views',
                ],
                'image_url' => 'images/packages/bbq_package.jpg',
                'is_popular' => false,
            ],
        ];

        // Create packages
        foreach ($packages as $packageData) {
            Package::create($packageData);
        }
    }
}