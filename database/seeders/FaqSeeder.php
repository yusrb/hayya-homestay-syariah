<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Mengisi data FAQ umum untuk website Glamping Hayya.
     */
    public function run(): void
    {
        // Daftar FAQ umum untuk website
        $faqs = [
            [
                'question' => 'Apa itu Hayya Glamping Syari\'ah?',
                'answer' => 'Hayya Glamping Syari\'ah adalah penginapan bergaya glamping di Tawangmangu, Solo, yang menawarkan pengalaman menginap nyaman dengan fasilitas modern dan suasana syari\'ah, dikelilingi pemandangan alam pegunungan.',
            ],
            [
                'question' => 'Fasilitas apa saja yang tersedia di setiap villa?',
                'answer' => 'Setiap villa dilengkapi tempat tidur king-size (180x200), kamar mandi dalam dengan air panas, smart TV, WiFi, sofa bed, handuk, peralatan sholat, sarapan untuk 3 orang, teko listrik, serta air mineral, teh, dan kopi gratis.',
            ],
            [
                'question' => 'Bagaimana cara melakukan pemesanan?',
                'answer' => 'Pemesanan dapat dilakukan melalui website kami atau dengan menghubungi kontak resmi. Anda perlu memberikan detail seperti nama, tanggal menginap, dan jumlah kamar, serta membayar deposit minimal 50% ke rekening BSI 7227259439 atas nama NAUFAL ALY MAS UD.',
            ],
            [
                'question' => 'Kapan waktu check-in dan check-out?',
                'answer' => 'Check-in dimulai pukul 14:00, dan check-out paling lambat pukul 12:00.',
            ],
            [
                'question' => 'Apakah ada kebijakan khusus untuk pasangan suami-istri?',
                'answer' => 'Ya, pasangan suami-istri yang menginap berdua wajib mengirimkan foto buku nikah saat pemesanan untuk mematuhi kebijakan syari\'ah kami.',
            ],
            [
                'question' => 'Apakah ada aktivitas tambahan yang ditawarkan?',
                'answer' => 'Kami menyediakan tur Jeep Adventure dan paket BBQ Grill yang dapat ditambahkan ke pemesanan Anda. Silakan hubungi kami untuk informasi lebih lanjut.',
            ],
            [
                'question' => 'Bagaimana kebijakan pembatalan pemesanan?',
                'answer' => 'Untuk informasi pembatalan, silakan hubungi kami langsung. Kebijakan pengembalian dana akan disesuaikan dengan ketentuan pemesanan.',
            ],
            [
                'question' => 'Apakah lokasi glamping aman dan nyaman?',
                'answer' => 'Ya, lokasi kami di Tawangmangu bagian atas menawarkan udara sejuk, pemandangan indah, dan fasilitas seperti parkir luas, mushola, serta rooftop dengan pemandangan 360 derajat untuk kenyamanan Anda.',
            ],
        ];

        // Membuat data FAQ
        foreach ($faqs as $faqData) {
            Faq::create($faqData);
        }
    }
}