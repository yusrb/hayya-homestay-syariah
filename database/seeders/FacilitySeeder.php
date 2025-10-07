<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityImage;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Seed facilities data based on Glamping Hayya's amenities.
     */
    public function run(): void
    {

        $facilities = [
            [
                'name' => 'Glamping Villa',
                'description' => '14 units of glamping-style villas',
                'icon' => 'fas fa-home',
                'image' => 'images/facilities/glamping_hayya.jpeg', 
            ],
            [
                'name' => 'King Size Bed',
                'description' => '1 springbed size 180x200',
                'icon' => 'fas fa-bed',
                'image' => 'images/facilities/kamar.jpg', 
            ],
            [
                'name' => 'Private Bathroom',
                'description' => 'Bathroom with hot water (heater) and shower',
                'icon' => 'fas fa-bath',
                'image' => 'images/facilities/bathroom.jpg', 
            ],
            [
                'name' => 'Washbasin',
                'description' => 'Washbasin in each villa',
                'icon' => 'fas fa-sink',
                'image' => null,
            ],
            [
                'name' => 'Smart TV',
                'description' => 'W LED Smart TV in each villa',
                'icon' => 'fas fa-tv',
                'image' => null,
            ],
            [
                'name' => 'WiFi',
                'description' => 'Free WiFi access',
                'icon' => 'fas fa-wifi',
                'image' => null,
            ],
            [
                'name' => 'Sofa Bed',
                'description' => 'Comfortable sofa bed in each villa',
                'icon' => 'fas fa-couch',
                'image' => null,
            ],
            [
                'name' => 'Towels',
                'description' => 'Provided towels (not to be taken home)',
                'icon' => 'fas fa-tshirt',
                'image' => null,
            ],
            [
                'name' => 'Prayer Equipment',
                'description' => 'Prayer mats and equipment provided',
                'icon' => 'fas fa-pray',
                'image' => null,
            ],
            [
                'name' => 'Breakfast',
                'description' => 'Breakfast for 3 persons per room',
                'icon' => 'fas fa-utensils',
                'image' => null,
            ],
            [
                'name' => 'Electric Kettle',
                'description' => 'Electric kettle with glasses in each villa',
                'icon' => 'fas fa-mug-hot',
                'image' => null,
            ],
            [
                'name' => 'Complimentary Drinks',
                'description' => 'Mineral water, sugar, tea, and coffee provided',
                'icon' => 'fas fa-coffee',
                'image' => null,
            ],
            [
                'name' => 'Mountain View',
                'description' => 'Beautiful mountain and nature views',
                'icon' => 'fas fa-mountain',
                'image' => null,
            ],
            [
                'name' => 'Sunset View',
                'description' => 'Stunning sunset view (weather permitting)',
                'icon' => 'fas fa-sun',
                'image' => null,
            ],
            [
                'name' => 'City Light View',
                'description' => 'Night view of Solo city lights',
                'icon' => 'fas fa-city',
                'image' => null,
            ],
            [
                'name' => 'Cool Climate',
                'description' => 'Cool and fresh air at upper Tawangmangu',
                'icon' => 'fas fa-wind',
                'image' => null,
            ],
            [
                'name' => 'Mushola',
                'description' => 'Prayer room available on-site',
                'icon' => 'fas fa-mosque',
                'image' => null,
            ],
            [
                'name' => 'Rooftop',
                'description' => 'Rooftop with 360° panoramic view',
                'icon' => 'fas fa-building',
                'image' => null,
            ],
            [
                'name' => 'Gazebo',
                'description' => 'Gazebo for relaxation',
                'icon' => 'fas fa-umbrella',
                'image' => null,
            ],
            [
                'name' => 'Parking',
                'description' => 'Spacious parking area',
                'icon' => 'fas fa-parking',
                'image' => null,
            ],
        ];

        foreach ($facilities as $facilityData) {
            $facility = Facility::create([
                'name' => $facilityData['name'],
                'description' => $facilityData['description'],
                'icon' => $facilityData['icon'],
            ]);

            if ($facilityData['image']) { 
                FacilityImage::create([
                    'facility_id' => $facility->id,
                    'file_path' => $facilityData['image'], 
                    'is_primary' => true,
                ]);
            }
        }
    }
}