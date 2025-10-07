<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = [
            [
                'type' => 'foto',
                'title' => 'Pemandangan Pagi Hari Glamping',
                'description' => 'Keindahan kabut pagi menyelimuti area glamping.',
                'file_path' => 'images/gallery/img/galeri1.jpg',
            ],
            [
                'type' => 'foto',
                'title' => 'Tenda Mewah di Tengah Alam',
                'description' => 'Fasilitas glamping syariah yang nyaman dan elegan.',
                'file_path' => 'images/gallery/img/galeri2.jpg',
            ],
            [
                'type' => 'foto',
                'title' => 'Pemandangan dari Depan Hayya',
                'description' => 'Area dek untuk bersantai menikmati udara pegunungan.',
                'file_path' => 'images/gallery/img/galeri3.jpg',
            ],
            [
                'type' => 'foto',
                'title' => 'Interior Kamar Glamping',
                'description' => 'Desain interior yang hangat dan menenangkan.',
                'file_path' => 'images/gallery/img/galeri4.jpg',
            ],
            [
                'type' => 'foto',
                'title' => 'Suasana Malam Glamping',
                'description' => 'Lampu-lampu cantik menerangi area tenda di malam hari.',
                'file_path' => 'images/gallery/img/galeri5.jpg',
            ],
            [
                'type' => 'foto',
                'title' => 'Halaman Luar',
                'description' => 'Selamat datang di Hayya Syariah Glamping.',
                'file_path' => 'images/gallery/img/galeri6.jpg',
            ],
            [
                'type' => 'video',
                'title' => 'Promosi 1',
                'description' => 'Selamat datang di Hayya Syariah Glamping.',
                'file_path' => 'images/gallery/video/IMG_8084.mp4',
            ],
            [
                'type' => 'video',
                'title' => 'Promosi 2',
                'description' => 'Selamat datang di Hayya Syariah Glamping.',
                'file_path' => 'images/gallery/video/IMG_8084.mp4',
            ],
        ];

        foreach ($galleryItems as $item) {
            GalleryItem::create($item);
        }
    }
}