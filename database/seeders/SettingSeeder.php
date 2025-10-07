<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed settings data for Glamping Hayya.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'Hayya Syariah Glamping',
            'description' => 'Glamping mewah di kebun teh hijau dengan fasilitas syariah lengkap untuk keluarga muslim.',
            'address' => 'Area Hutan Lindung, Blumbang, Kec. Tawangmangu, Kabupaten Karanganyar, Jawa Tengah 57792',
            'phone' => '+6287761235725',
            'email' => 'info@hayyasyariahglamping.com',
            'whatsapp_number' => '+6287761235725',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.2121657852467!2d111.15768367340432!3d-7.660323592356137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e798b2a4bc7b35f%3A0x57cac1f44db98a0e!2sHayya%20Glamping%20Syariah!5e0!3m2!1sid!2sid!4v1759198112523!5m2!1sid!2sid',
        ]);
    }
}