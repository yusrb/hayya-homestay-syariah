<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->name ?? 'Hayya Syariah Homestay' }} - Kamar Glamping Syariah</title>
    <meta name="description" content="Jelajahi pilihan kamar glamping syariah premium di Hayya Syariah Glamping dengan fasilitas lengkap untuk keluarga Muslim.">
    <meta name="keywords" content="glamping syariah, kamar halal, penginapan islami, akomodasi muslim, mushola pribadi">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .modal.show {
            display: flex;
        }
        .navbar-scrolled {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #e5e7eb;
        }
        .navbar-scrolled .text-white {
            color: #047857;
        }
        .navbar-scrolled .hover\:text-emerald-600 {
            color: #047857;
        }
        .navbar-scrolled .hover\:text-emerald-600:hover {
            color: #065f46;
        }
        .navbar-scrolled .border-emerald-600 {
            border-color: #10b981;
        }
        .navbar-scrolled .text-emerald-600 {
            color: #10b981;
        }
        .navbar-scrolled .hover\:bg-emerald-600:hover {
            background-color: #10b981;
        }
        .navbar-scrolled .hover\:text-white:hover {
            color: #ffffff;
        }
        .navbar-scrolled .bg-emerald-600 {
            background-color: #10b981;
        }
        .navbar-scrolled .text-white {
            color: #404040;
        }
        .navbar-scrolled .hubungi {
            color: #10b981;
            border: 1px solid #10b981;
        }
        .navbar-scrolled .reservasi {
            color: #ffffff;
        }
        .navbar-scrolled .ri-tent-line {
            color: #ffffff;
        }

        .hero-section {
            background-image: url('/storage/images/gallery/img/galeri1.jpg'); 
            
            background-size: cover;
            background-position: center;
            background-attachment: fixed;

            min-height: 100vh;
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;

            display: flex;
            flex-direction: column;
            justify-content: center;
            
            min-height: 70vh; 
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #047857, #10b981);
            border-radius: 2px;
        }
        .glamping-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        .glamping-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .glamping-card img {
            transition: transform 0.5s ease;
        }
        .glamping-card:hover img {
            transform: scale(1.05);
        }
        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 10;
        }
        .feature-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(4, 120, 87, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: rgba(4, 120, 87, 0.2);
        }
        .filter-btn {
            transition: all 0.3s ease;
            border-radius: 30px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }
        .filter-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        .filter-btn:hover:before {
            left: 100%;
        }
        .btn-primary {
            background: linear-gradient(135deg, #047857 0%, #10b981 100%);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(4, 120, 87, 0.2);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(4, 120, 87, 0.3);
        }
        .btn-outline {
            background: transparent;
            color: #047857;
            border: 2px solid #047857;
            border-radius: 30px;
            padding: 10px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: #047857;
            color: white;
        }
        footer {
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        }
        .footer-links a {
            position: relative;
            transition: all 0.3s ease;
        }
        .footer-links a:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #10b981;
            transition: width 0.3s ease;
        }
        .footer-links a:hover:after {
            width: 100%;
        }
        .mobile-menu {
            max-height: 0;
            opacity: 0;
            transition: all 0.4s ease;
            overflow: hidden;
        }
        .mobile-menu.open {
            max-height: 500px;
            opacity: 1;
        }
        .scrollbar-thin {
            scrollbar-width: thin;
        }
        .scrollbar-thumb-emerald-600 {
            scrollbar-color: #047857 #e5e7eb;
        }
        .scrollbar-track-gray-100 {
            scrollbar-color: #047857 #f3f4f6;
        }
        .glamping-gallery::-webkit-scrollbar {
            height: 8px;
        }
        .glamping-gallery::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 8px;
        }
        .glamping-gallery::-webkit-scrollbar-thumb {
            background: #047857;
            border-radius: 8px;
        }
        .glamping-gallery::-webkit-scrollbar-thumb:hover {
            background: #065f46;
        }
        @media (max-width: 768px) {
            .hero-section {
                background-attachment: scroll;
            }
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }
    </style>
</head>
<body>
    <div id="root" class="min-h-screen">
        <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-20">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Hayya Admin Logo" class="h-12 w-12 object-cover rounded-full">
                        </div>
                        <div>
                            <div class="font-bold text-lg text-white" style="font-family: Amiri, serif;">
                                {{ $setting->name ?? 'Hayya Syariah' }}
                            </div>
                            <div class="text-sm relative bottom-1 text-emerald-300">Glamping Islami</div>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home.index') }}#hero" class="font-medium hover:text-emerald-600 text-white nav-link">Home</a>
                        <a href="{{ route('home.kamar') }}" class="font-medium text-white hover:text-emerald-600 nav-link">Kamar</a>
                        <a href="{{ route('home.index') }}#fasilitas" class="font-medium hover:text-emerald-600 text-white nav-link">Fasilitas</a>
                        <a href="{{ route('home.index') }}#galeri" class="font-medium hover:text-emerald-600 text-white nav-link">Galeri</a>
                        <a href="{{ route('home.index') }}#tentang" class="font-medium hover:text-emerald-600 text-white nav-link">Tentang</a>
                    </div>
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}"
                            class="hubungi font-medium rounded-lg flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-6 py-3">
                            <i class="ri-phone-line mr-2"></i>Hubungi
                        </a>
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah."
                            class="reservasi font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3">
                            <i class="ri-whatsapp-line mr-2"></i>Reservasi
                        </a>
                    </div>
                    <button class="lg:hidden p-2 rounded-lg text-white hover:bg-white/10">
                        <i class="text-xl ri-menu-line"></i>
                    </button>
                </div>
                <div class="lg:hidden transition-all duration-300 overflow-hidden max-h-0 opacity-0">
                    <div class="py-4 space-y-4 bg-white/95 rounded-2xl mt-2 shadow-xl">
                        <a href="{{ route('home.index') }}#hero" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Home</a>
                        <a href="{{ route('home.kamar') }}" class="block px-6 py-2 text-emerald-600 font-medium nav-link">Kamar</a>
                        <a href="{{ route('home.index') }}#fasilitas" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Fasilitas</a>
                        <a href="{{ route('home.index') }}#galeri" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Galeri</a>
                        <a href="{{ route('home.index') }}#tentang" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Tentang</a>
                        <div class="px-6 py-2 space-y-3">
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}"
                                class="font-medium rounded-lg flex items-center border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white px-6 py-3 w-full">
                                <i class="ri-phone-line mr-2"></i>Hubungi Kami
                            </a>
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah."
                                class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 w-full">
                                <i class="ri-whatsapp-line mr-2"></i>Reservasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="hero-section pt-32 pb-20 flex items-center justify-center text-white">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6" style="font-family: Amiri, serif;">Kamar Glamping Syariah</h1>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8 leading-relaxed">Pilih akomodasi premium kami yang dirancang khusus untuk kenyamanan keluarga Muslim dengan fasilitas syariah lengkap.</p>
                <div class="flex justify-center space-x-4">
                    <a href="#glamping" class="btn-primary font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3">
                        <i class="ri-eye-line mr-2"></i>Lihat Kamar
                    </a>
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah."
                        class="btn-outline font-medium rounded-lg flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-6 py-3">
                        <i class="ri-whatsapp-line mr-2"></i>Reservasi
                    </a>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white" id="glamping">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-emerald-100 text-emerald-700 rounded-full px-4 py-2 mb-4 font-medium">
                        <i class="ri-tent-line mr-2"></i>
                        <span>Glamping Kami</span>
                    </div>
                    <h2 class="section-title text-4xl md:text-5xl font-bold text-gray-800" style="font-family: Amiri, serif;">
                        Pilih <span class="text-emerald-600">Glamping Favorit</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto mt-4">Temukan glamping syariah premium dengan fasilitas lengkap untuk keluarga Muslim.</p>
                </div>
                <div class="mb-12 flex flex-wrap gap-4 justify-center">
                    <button class="filter-btn active bg-emerald-600 text-white px-6 py-3 font-medium rounded-lg">Semua</button>
                    <button class="filter-btn bg-white text-emerald-600 border border-emerald-200 px-6 py-3 font-medium rounded-lg" data-filter="available">Tersedia</button>
                    <button class="filter-btn bg-white text-emerald-600 border border-emerald-200 px-6 py-3 font-medium rounded-lg" data-filter="standard">Standard</button>
                    <button class="filter-btn bg-white text-emerald-600 border border-emerald-200 px-6 py-3 font-medium rounded-lg" data-filter="deluxe">Deluxe</button>
                    <button class="filter-btn bg-white text-emerald-600 border border-emerald-200 px-6 py-3 font-medium rounded-lg" data-filter="family">Keluarga</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 glamping-grid">
                    @forelse($glampings as $glamping)
                    <div class="glamping-card" data-status="{{ $glamping->status }}" data-type="{{ $glamping->type }}">
                        <div class="relative overflow-hidden">
                            <img alt="{{ $glamping->title }}" class="w-full h-64 object-cover"
                                 src="{{ $glamping->images->first() ? asset('storage/' . $glamping->images->first()->image_path) : asset('images/placeholder.jpg') }}">
                            <div class="status-badge {{ $glamping->status == 'available' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $glamping->status == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent text-white">
                                <h3 class="text-xl font-bold mb-2" style="font-family: Amiri, serif;">{{ $glamping->title }}</h3>
                                <div class="flex items-center text-sm opacity-90">
                                    <i class="ri-map-pin-line mr-1"></i>
                                    <span>Lembang, Bandung</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="ri-user-line text-emerald-600"></i>
                                    <span>{{ $glamping->capacity }} Tamu</span>
                                </div>
                                <div class="flex items-center space-x-2 text-gray-600">
                                    <i class="ri-hotel-bed-line text-emerald-600"></i>
                                    <span>{{ $glamping->beds }} Tempat Tidur</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-2xl font-bold text-emerald-600">Rp {{ number_format($glamping->price, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ malam</span></span>
                                <div class="flex text-amber-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ri-star-fill {{ $i <= $glamping->rating ? '' : 'opacity-30' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <button onclick="showGlampingModal({{ json_encode($glamping->toArray()) }})" class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 w-full">
                                <i class="ri-eye-line mr-2"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <div class="max-w-md mx-auto">
                            <i class="ri-tent-line text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-500 mb-2" style="font-family: Amiri, serif;">Belum ada glamping tersedia</h3>
                            <p class="text-gray-400">Kami sedang mempersiapkan pengalaman terbaik untuk Anda.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                @if($glampings->hasPages())
                <div class="text-center mt-12">
                    <div class="flex justify-center space-x-2">
                        @if($glampings->onFirstPage())
                        <span class="px-4 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <i class="ri-arrow-left-s-line"></i>
                        </span>
                        @else
                        <a href="{{ $glampings->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
                            <i class="ri-arrow-left-s-line"></i>
                        </a>
                        @endif
                        @if($glampings->hasMorePages())
                        <a href="{{ $glampings->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all">
                            <i class="ri-arrow-right-s-line"></i>
                        </a>
                        @else
                        <span class="px-4 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <i class="ri-arrow-right-s-line"></i>
                        </span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </section>

        <section class="py-20 bg-gradient-to-br from-emerald-50 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-amber-100 text-amber-700 rounded-full px-4 py-2 mb-4 font-medium">
                        <i class="ri-information-line mr-2"></i>
                        <span>Mengapa Memilih Kami</span>
                    </div>
                    <h2 class="section-title text-4xl md:text-5xl font-bold text-gray-800" style="font-family: Amiri, serif;">
                        Keunggulan <span class="text-emerald-600">Kamar Syariah</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto mt-4">Nikmati pengalaman menginap yang nyaman, halal, dan penuh berkah di tengah alam indah.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="feature-card">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                            <i class="ri-shield-check-line text-3xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4" style="font-family: Amiri, serif;">100% Syariah Compliant</h3>
                        <p class="text-gray-600 leading-relaxed">Semua kamar dirancang sesuai prinsip Islam dengan mushola pribadi, arah kiblat, dan fasilitas halal lengkap.</p>
                    </div>
                    <div class="feature-card">
                        <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mb-4">
                            <i class="ri-leaf-line text-3xl text-amber-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4" style="font-family: Amiri, serif;">Ramah Lingkungan</h3>
                        <p class="text-gray-600 leading-relaxed">Material eco-friendly dan desain yang menyatu dengan alam pegunungan untuk pengalaman yang lebih dekat dengan alam.</p>
                    </div>
                    <div class="feature-card">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                            <i class="ri-star-line text-3xl text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4" style="font-family: Amiri, serif;">Fasilitas Premium</h3>
                        <p class="text-gray-600 leading-relaxed">AC, WiFi cepat, kamar mandi dalam, kitchenette, dan view kebun teh yang menakjubkan dari setiap kamar.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4" style="font-family: Amiri, serif;">Siap Mengalami Pengalaman Glamping Syariah?</h2>
                <p class="text-xl max-w-2xl mx-auto mb-8 opacity-90">Reservasi sekarang dan nikmati kenyamanan akomodasi halal dengan pemandangan alam terbaik.</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah."
                        class="font-medium rounded-lg flex items-center bg-white text-emerald-700 hover:bg-gray-100 px-6 py-3">
                        <i class="ri-whatsapp-line mr-2"></i>Reservasi via WhatsApp
                    </a>
                    <a href="tel:{{ $setting->whatsapp_number ?? '+6281234567890' }}"
                        class="font-medium rounded-lg flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-700 px-6 py-3">
                        <i class="ri-phone-line mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 text-white">
            <div class="container mx-auto px-4 py-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-4" style="font-family: Amiri, serif;">
                            {{ $setting->name ?? 'Hayya Syariah Glamping' }}
                        </h3>
                        <p class="text-gray-400 text-justify leading-relaxed">
                            {{ $setting->description ?? 'Glamping syariah pertama di Indonesia, harmonis dengan alam dan nilai Islami.' }}
                        </p>
                        <div class="flex space-x-3 mt-4">
                            <a href="#" class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="ri-instagram-line text-white"></i>
                            </a>
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}"
                                class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="ri-whatsapp-line text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-emerald-300">Quick Links</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home.index') }}#tentang" class="text-gray-400 hover:text-emerald-300 transition-colors duration-200">Tentang Kami</a></li>
                            <li><a href="{{ route('home.index') }}#fasilitas" class="text-gray-400 hover:text-emerald-300 transition-colors duration-200">Fasilitas</a></li>
                            <li><a href="{{ route('home.kamar') }}" class="text-gray-400 hover:text-emerald-300 transition-colors duration-200">Kamar</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-emerald-300">Kontak</h4>
                        <div class="space-y-4 text-gray-400 text-sm">
                            <div class="flex items-start space-x-3">
                                <i class="ri-map-pin-line text-emerald-400 mt-1"></i>
                                <div>{{ $setting->address ?? 'Jl. Raya Lembang No. 123, Desa Cikole, Lembang, Bandung Barat 40391' }}</div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="ri-whatsapp-line text-emerald-400"></i>
                                <div>{{ $setting->whatsapp_number ?? '+62 812-3456-7890' }}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-emerald-300">Layanan</h4>
                        <ul class="space-y-3 text-gray-400 text-sm">
                            <li class="flex items-center space-x-2">
                                <i class="ri-check-line text-emerald-400"></i>
                                <span>Glamping Syariah</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="ri-check-line text-emerald-400"></i>
                                <span>Halal Food & Beverage</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="ri-check-line text-emerald-400"></i>
                                <span>Alam Asri & Ramah Lingkungan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800">
                <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm space-y-3 md:space-y-0">
                    <div>© 2025 Hayya Syariah Glamping. All rights reserved.</div>
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-emerald-300 transition-colors duration-200">Privacy Policy</a>
                        <a href="#" class="hover:text-emerald-300 transition-colors duration-200">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

        <div id="modal-container" class="modal">
            <div class="modal-content">
                <div id="modal-inner"></div>
            </div>
        </div>

        <script>
            function showGlampingModal(glamping) {
                let modalContent = `
                    <div class="relative">
                        <button onclick="closeModal()" class="absolute top-4 right-4 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-gray-700 hover:text-emerald-600 transition-colors">
                            <i class="ri-close-line text-xl"></i>
                        </button>
                        <div class="grid grid-cols-1 lg:grid-cols-2">
                            <div class="relative h-80 lg:h-full">
                                <img src="${glamping.images && glamping.images.length > 0 ? '/storage/' + glamping.images[0].image_path : '/images/placeholder.jpg'}" 
                                     alt="${glamping.title.replace(/</g, '&lt;').replace(/>/g, '&gt;')}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent text-white">
                                    <h3 class="text-2xl font-bold mb-2" style="font-family: Amiri, serif;">${glamping.title.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</h3>
                                    <div class="flex items-center text-sm opacity-90">
                                        <i class="ri-map-pin-line mr-1"></i>
                                        <span>Lembang, Bandung</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-2xl font-bold text-emerald-600">Rp ${new Intl.NumberFormat('id-ID').format(glamping.price)} <span class="text-sm font-normal text-gray-500">/ malam</span></span>
                                    <div class="flex text-amber-500">
                                        ${Array(5).fill().map((_, i) => 
                                            `<i class="ri-star-fill ${i < glamping.rating ? '' : 'opacity-30'}"></i>`
                                        ).join('')}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="ri-user-line text-emerald-600"></i>
                                        <span>${glamping.capacity} Tamu</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="ri-hotel-bed-line text-emerald-600"></i>
                                        <span>${glamping.beds} Tempat Tidur</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4">${glamping.description || 'Tidak ada deskripsi tersedia.'}</p>
                                <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah."
                                    class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 w-full">
                                    <i class="ri-whatsapp-line mr-2"></i>Reservasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                showModal(modalContent);
            }

            function showModal(content) {
                const modal = document.getElementById('modal-container');
                const modalInner = document.getElementById('modal-inner');
                modalInner.innerHTML = content;
                modal.classList.add('show');
            }

            function closeModal() {
                const modal = document.getElementById('modal-container');
                modal.classList.remove('show');
            }

            document.addEventListener('DOMContentLoaded', function () {
                const navLinks = document.querySelectorAll('.nav-link');
                const navToggle = document.querySelector('.lg\\:hidden.p-2.rounded-lg.text-white');
                const navMenu = document.querySelector('.lg\\:hidden.transition-all');
                const navbar = document.querySelector('nav');
                navLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const href = link.getAttribute('href');
                        if (href.startsWith('#')) {
                            const targetId = href.substring(1);
                            const targetSection = document.getElementById(targetId);
                            if (targetSection) {
                                window.scrollTo({
                                    top: targetSection.offsetTop - 80,
                                    behavior: 'smooth'
                                });
                                if (navMenu && !navMenu.classList.contains('max-h-0')) {
                                    navMenu.classList.add('max-h-0', 'opacity-0');
                                    navMenu.classList.remove('max-h-screen', 'opacity-100');
                                }
                            }
                        } else {
                            window.location.href = href;
                        }
                    });
                });
                if (navToggle && navMenu) {
                    navToggle.addEventListener('click', () => {
                        const isOpen = navMenu.classList.contains('max-h-0');
                        navMenu.classList.toggle('max-h-0', !isOpen);
                        navMenu.classList.toggle('max-h-screen', isOpen);
                        navMenu.classList.toggle('opacity-0', !isOpen);
                        navMenu.classList.toggle('opacity-100', isOpen);
                    });
                }
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        navbar.classList.add('navbar-scrolled');
                    } else {
                        navbar.classList.remove('navbar-scrolled');
                    }
                });
                const filterButtons = document.querySelectorAll('.filter-btn');
                const glampingCards = document.querySelectorAll('.glamping-card');
                filterButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        filterButtons.forEach(btn => {
                            btn.classList.remove('active', 'bg-emerald-600', 'text-white');
                            btn.classList.add('bg-white', 'text-emerald-600', 'border', 'border-emerald-200');
                        });
                        button.classList.add('active', 'bg-emerald-600', 'text-white');
                        button.classList.remove('bg-white', 'text-emerald-600', 'border', 'border-emerald-200');
                        const filter = button.getAttribute('data-filter');
                        glampingCards.forEach(card => {
                            const status = card.getAttribute('data-status');
                            const type = card.getAttribute('data-type');
                            if (filter === 'all' || filter === status || filter === type) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
            });
        </script>
    </div>
</body>
</html>