<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GalleryItemSeeder::class,
            GlampingSeeder::class,
            FacilitySeeder::class,
            PackageSeeder::class,
            SettingSeeder::class,
            FaqSeeder::class,
            UserSeeder::class,
        ]);
    }
}
