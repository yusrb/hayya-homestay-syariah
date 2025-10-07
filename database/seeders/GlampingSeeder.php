<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GlampingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('glampings')->insert([
            [
                'title' => 'Tenda Klasik',
                'type' => 'standard',
                'description' => 'Tenda standar dengan fasilitas dasar untuk dua orang.',
                'status' => 'available',
                'capacity' => 2,
                'beds' => 1,
                'price' => 500000, // Harga dalam Rupiah, contoh
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kabin Mewah',
                'type' => 'deluxe',
                'description' => 'Kabin premium dengan kamar mandi pribadi dan pemandangan indah.',
                'status' => 'available',
                'capacity' => 4,
                'beds' => 2,
                'price' => 1200000,
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rumah Pohon Keluarga',
                'type' => 'family',
                'description' => 'Akomodasi besar yang ideal untuk keluarga atau kelompok, di atas pohon.',
                'status' => 'unavailable',
                'capacity' => 6,
                'beds' => 3,
                'price' => 1800000,
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Glamping Minimalis',
                'type' => 'standard',
                'description' => 'Pengalaman glamping yang sederhana namun nyaman.',
                'status' => 'available',
                'capacity' => 2,
                'beds' => 1,
                'price' => 650000,
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}