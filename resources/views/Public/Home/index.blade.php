<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->name ?? 'Hayya Syariah Homestay' }} - Penginapan Syariah Modern Terbaik</title>
    <meta name="description" content="{{ $setting->description ?? 'Hayya Syariah Homestay menawarkan pengalaman menginap syariah modern dengan fasilitas premium, mushola pribadi, makanan halal, dan pelayanan islami terbaik di Indonesia.' }}">
    <meta name="keywords" content="homestay syariah, penginapan halal, hotel syariah, akomodasi islami, mushola pribadi, makanan halal">
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
        #gallery-modal .modal-content {
            background-color: transparent;
            padding: 0;
            width: 90%;
            max-width: 1200px;
            height: 80vh;
            box-shadow: none;
        }
        #gallery-modal img,
        #gallery-modal video {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }
        #gallery-modal .modal {
            background-color: rgba(0, 0, 0, 0.8);
        }
        #reservationModal::-webkit-scrollbar {
            width: 8px;
        }
        #reservationModal::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        #reservationModal::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        #reservationModal::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        #facility-modal .modal-content {
            max-width: 800px;
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
                            <div class="font-bold text-lg text-white">
                                {{ $setting->name ?? 'Hayya Syariah' }}
                            </div>
                            <div class="text-sm relative bottom-1 text-emerald-300">Glamping Islami</div>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="#hero" class="font-medium hover:text-emerald-600 text-white nav-link">Home</a>
                        <a href="{{ route('home.kamar') }}" class="font-medium hover:text-emerald-600 text-white nav-link">Kamar</a>
                        <a href="#fasilitas" class="font-medium hover:text-emerald-600 text-white nav-link">Fasilitas</a>
                        <a href="#galeri" class="font-medium hover:text-emerald-600 text-white nav-link">Galeri</a>
                        <a href="#tentang" class="font-medium hover:text-emerald-600 text-white nav-link">Tentang</a>
                    </div>
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="hubungi font-medium rounded-lg flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-6 py-3">
                            <i class="ri-phone-line mr-2"></i>Hubungi
                        </a>
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah." class="reservasi font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3">
                            <i class="ri-whatsapp-line mr-2"></i>Reservasi
                        </a>
                    </div>
                    <button class="lg:hidden p-2 rounded-lg text-white hover:bg-white/10">
                        <i class="text-xl ri-menu-line"></i>
                    </button>
                </div>
                <div class="lg:hidden transition-all duration-300 overflow-hidden max-h-0 opacity-0">
                    <div class="py-4 space-y-4 bg-white/95 rounded-2xl mt-2 shadow-xl">
                        <a href="#hero" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Home</a>
                        <a href="{{ route('home.kamar') }}" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Kamar</a>
                        <a href="#fasilitas" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Fasilitas</a>
                        <a href="#galeri" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Galeri</a>
                        <a href="#tentang" class="block px-6 py-2 text-gray-700 hover:text-emerald-600 nav-link">Tentang</a>
                        <div class="px-6 py-2 space-y-3">
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="font-medium rounded-lg flex items-center border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white px-6 py-3 w-full">
                                <i class="ri-phone-line mr-2"></i>Hubungi Kami
                            </a>
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah." class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 w-full">
                                <i class="ri-whatsapp-line mr-2"></i>Reservasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0">
                <div class="w-full h-full bg-cover bg-center filter brightness-90" style="background-image: url('https://readdy.ai/api/search-image?query=Luxury%20Islamic%20glamping%20villa%20nestled%20in%20beautiful%20green%20tea%20plantation%20hills%2C%20elegant%20white%20canvas%20tents%20with%20Islamic%20geometric%20patterns%2C%20terraced%20tea%20gardens%20stretching%20to%20horizon%2C%20golden%20sunrise%20light%20filtering%20through%20morning%20mist%2C%20peaceful%20mountain%20valley%20setting%2C%20traditional%20Islamic%20architecture%20elements%2C%20premium%20eco-friendly%20accommodation%2C%20serene%20atmosphere%20with%20lush%20greenery%2C%20professional%20landscape%20photography&width=1920&height=1080&seq=hero-tea-plantation-1&orientation=landscape');"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/60 to-emerald-900/30"></div>
            </div>
            <div class="relative z-10 container mx-auto px-6 text-center flex flex-col items-center justify-center min-h-screen">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-4 leading-tight">Hayya Syariah Glamping</h1>
                <p class="text-xl md:text-2xl lg:text-3xl text-amber-300 mb-6 font-medium">Glamping Islami Premium</p>
                <p class="text-base md:text-lg lg:text-xl text-gray-200 max-w-2xl mb-10 leading-relaxed">Glamping mewah di kebun teh hijau dengan fasilitas syariah lengkap untuk keluarga muslim.</p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo, saya ingin reservasi glamping syariah." class="font-semibold rounded-xl flex items-center bg-emerald-600 hover:bg-emerald-700 shadow-lg text-white px-8 py-4 text-lg transition duration-300 transform hover:-translate-y-1">
                        <i class="ri-whatsapp-line mr-3 text-2xl"></i>Reservasi via WhatsApp
                    </a>
                    <a href="#" class="font-semibold rounded-xl flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-8 py-4 text-lg transition duration-300 transform hover:-translate-y-1">
                        <i class="ri-play-circle-line mr-3 text-2xl"></i>Lihat Virtual Tour
                    </a>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-br from-white to-emerald-50" id="tentang">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center bg-emerald-100 rounded-full px-4 py-2 mb-6">
                            <i class="ri-information-line text-emerald-600 mr-2"></i>
                            <span class="text-emerald-800 text-sm font-medium">Tentang Kami</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                            Glamping <span class="text-emerald-600">Syariah Pertama</span> di Indonesia
                        </h2>
                        <p class="text-xl text-gray-600 mb-8">Hayya Syariah Glamping menghadirkan kemewahan alam dengan nilai-nilai Islam untuk keluarga muslim.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <i class="ri-restaurant-line text-emerald-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-2">100% Halal</h3>
                                    <p class="text-gray-600 text-sm">Makanan dan minuman tersertifikasi halal MUI</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                    <i class="ri-shield-user-line text-amber-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 mb-2">Privasi Terjaga</h3>
                                    <p class="text-gray-600 text-sm">Area terpisah untuk keluarga</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 p-6 bg-gradient-to-r from-emerald-50 to-amber-50 rounded-2xl border border-emerald-100">
                            <div class="flex items-center mb-3">
                                <i class="ri-award-line text-emerald-600 text-2xl mr-3"></i>
                                <h4 class="font-bold text-gray-800">Sertifikat Halal MUI</h4>
                            </div>
                            <p class="text-gray-600">Glamping pertama tersertifikasi halal MUI.</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="relative overflow-hidden rounded-3xl shadow-2xl">
                            <img alt="Keluarga Muslim di Glamping" class="w-full h-full object-cover" src="https://readdy.ai/api/search-image?query=Beautiful%20Islamic%20family%20enjoying%20luxury%20glamping%20experience%20in%20mountains%2C%20Muslim%20parents%20with%20children%20sitting%20outside%20elegant%20tent%2C%20Islamic%20geometric%20patterns%20visible%20on%20tent%20design%2C%20natural%20mountain%20backdrop%2C%20sunrise%20lighting%2C%20family%20bonding%20moment%2C%20halal%20lifestyle%2C%20contemporary%20Islamic%20fashion%2C%20professional%20family%20photography&width=600&height=700&seq=about-family&orientation=portrait">
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-6 shadow-xl">
                            <div class="text-3xl font-bold text-emerald-600 mb-1">1000+</div>
                            <div class="text-gray-600 text-sm">Keluarga Puas</div>
                        </div>
                        <div class="absolute -top-6 -right-6 bg-white rounded-2xl p-6 shadow-xl">
                            <div class="text-3xl font-bold text-amber-600 mb-1">4.9</div>
                            <div class="text-gray-600 text-sm">Rating Google</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-br from-emerald-50 to-white" id="fasilitas">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-amber-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-service-line text-amber-600 mr-2"></i>
                        <span class="text-amber-800 text-sm font-medium">Fasilitas Kami</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Fasilitas <span class="text-emerald-600">Premium Syariah</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Kemewahan alam dengan fasilitas syariah lengkap untuk glamping tak terlupakan.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($facilities as $facility)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="relative overflow-hidden">
                            <img alt="{{ $facility->name }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $facility->primaryImage() ? asset('storage/' . $facility->primaryImage()->file_path) : asset('') }}">
                            <div class="absolute top-4 left-4 w-12 h-12 bg-emerald-600/90 rounded-xl flex items-center justify-center">
                                <i class="{{ $facility->icon }} text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600">{{ $facility->name }}</h3>
                            <p class="text-gray-600">{{ Str::limit($facility->description, 100) }}</p>
                            <button onclick="showFacilityModal({{ $facility->id }})" class="mt-4 flex items-center text-emerald-600 font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="mr-2">Lihat detail</span>
                                <i class="ri-arrow-right-line group-hover:translate-x-2 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="facility-modal" class="modal">
                    <div class="modal-content">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Detail Fasilitas</h3>
                            <button onclick="closeFacilityModal()" class="text-gray-600 hover:text-gray-800">
                                <i class="fa-solid fa-times text-xl"></i>
                            </button>
                        </div>
                        <div id="facility-modal-content"></div>
                    </div>
                </div>
            </div>
        </section>
       <section class="py-20 bg-gradient-to-br from-gray-50 to-emerald-50" id="galeri">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-amber-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-gallery-line text-amber-600 mr-2"></i>
                        <span class="text-amber-800 text-sm font-medium">Galeri Kami</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Dokumentasi <span class="text-emerald-600">Keindahan Alam</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Saksikan keindahan alam pegunungan dan kemewahan fasilitas glamping syariah melalui koleksi foto dan video berkualitas tinggi</p>
                </div>
                <div class="flex justify-center mb-12">
                    <div class="bg-white rounded-full p-2 shadow-lg">
                        <button data-tab="foto" class="tab-button px-8 py-3 rounded-full font-semibold transition-all cursor-pointer whitespace-nowrap bg-emerald-600 text-white">
                            <i class="ri-image-line mr-2"></i>Foto
                        </button>
                        <button data-tab="video" class="tab-button px-8 py-3 rounded-full font-semibold transition-all cursor-pointer whitespace-nowrap text-gray-600 hover:text-emerald-600">
                            <i class="ri-video-line mr-2"></i>Video
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 gallery-container">
                    @forelse($galleryItems as $item)
                    <div class="gallery-item {{ $item->type }}" data-type="{{ $item->type }}" style="display: none;">
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
                            @if($item->type == 'foto')
                            <img alt="{{ $item->title }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700" src="{{ asset('storage/' . $item->file_path) }}">
                            @else
                            <video class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700" controls>
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            </video>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-white font-semibold mb-2">{{ $item->title }}</h3>
                                    <div class="flex items-center text-white/80">
                                        <i class="ri-zoom-in-line mr-2"></i>
                                        <span class="text-sm">Klik untuk {{ $item->type == 'foto' ? 'memperbesar' : 'memutar' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 w-8 h-8 border-2 border-white/50 rotate-45 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center text-gray-600 py-8">Belum ada foto atau video tersedia saat ini.</div>
                    @endforelse
                </div>
                <div class="text-center mt-12">
                    {{-- Tambahkan ID untuk diakses JS --}}
                    <button id="load-more-gallery" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-full font-semibold transition-colors cursor-pointer whitespace-nowrap">
                        <i class="ri-add-line mr-2"></i>Lihat Lebih Banyak
                    </button>
                </div>
                <div class="mt-16 bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-8 text-center text-white">
                    <div class="max-w-2xl mx-auto">
                        <i class="ri-instagram-line text-4xl mb-4"></i>
                        <h3 class="text-2xl font-bold mb-4">Follow Instagram @hayyasyariahglamping</h3>
                        <p class="text-lg mb-6 text-white/90">Dapatkan update foto dan video terbaru dari keseruan glamping syariah kami</p>
                        <button class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors cursor-pointer whitespace-nowrap">
                            <a href="https://www.instagram.com/hayya_homestay_syariah/" target="__blank">
                            <i class="ri-instagram-line mr-2"></i>Follow Sekarang
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-br from-emerald-50 to-amber-50" id="testimoni">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-amber-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-heart-3-line text-amber-600 mr-2"></i>
                        <span class="text-amber-800 text-sm font-medium">Testimoni & Reviews</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Apa Kata <span class="text-emerald-600">Keluarga Muslim</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Pengalaman nyata dari keluarga-keluarga muslim yang telah merasakan keberkahan dan kenyamanan glamping syariah bersama kami</p>
                </div>
                <div class="max-w-5xl mx-auto">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="relative bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-gray-100 mb-12 testimoni-carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                            <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center">
                                <i class="ri-double-quotes-l text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="text-center mb-8">
                            <div class="flex justify-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="ri-star-fill text-amber-500 text-xl mx-1 {{ $i <= $testimonial->rating ? '' : 'opacity-50' }}"></i>
                                @endfor
                            </div>
                            <p class="text-xl md:text-2xl text-gray-700 leading-relaxed mb-8 italic">"{{ $testimonial->text }}"</p>
                            <div class="flex items-center justify-center space-x-4">
                                <img alt="{{ $testimonial->name }}" class="w-16 h-16 rounded-full object-cover shadow-lg" src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('images/placeholder-user.jpg') }}">
                                <div class="text-left">
                                    <h4 class="font-bold text-lg text-gray-800">{{ $testimonial->name }}</h4>
                                    <p class="text-emerald-600 font-medium">{{ $testimonial->location }}</p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="ri-google-line mr-1"></i>
                                        <span>{{ $testimonial->source ?? '-' }} • {{ $testimonial->date ? $testimonial->date->diffForHumans() : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="flex justify-center mb-12 space-x-2 testimoni-dots">
                        @foreach($testimonials as $index => $testimonial)
                        <button class="w-3 h-3 rounded-full transition-all cursor-pointer {{ $index === 0 ? 'bg-emerald-600 w-8' : 'bg-gray-300 hover:bg-gray-400' }}"></button>
                        @endforeach
                    </div>
                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-gray-100 mb-12">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="ri-google-line text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Google Reviews</h3>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                            <i class="ri-star-fill text-amber-500"></i>
                                            @endfor
                                        </div>
                                        <span class="text-gray-600">4.8 dari 5 (212 reviews)</span>
                                    </div>
                                </div>
                            </div>
                            <a href="https://www.google.co.id/maps/place/Hayya+Glamping+Syariah/@-7.6603183,111.1576837,17z/data=!4m8!3m7!1s0x2e798b2a4bc7b35f:0x57cac1f44db98a0e!8m2!3d-7.6603236!4d111.1602586!9m1!1b1!16s%2Fg%2F11tx2y14bz?hl=id&entry=ttu&g_ep=EgoyMDI1MDkxNy4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors cursor-pointer whitespace-nowrap">
                                <i class="ri-external-link-line mr-2"></i>Lihat Semua Review
                            </a>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">1,200+</div>
                        <div class="text-gray-600">Keluarga Puas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">4.9</div>
                        <div class="text-gray-600">Rating Google</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">98%</div>
                        <div class="text-gray-600">Tingkat Kepuasan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-emerald-600 mb-2">24/7</div>
                        <div class="text-gray-600">Customer Service</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-white" id="lokasi">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-emerald-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-map-pin-line text-emerald-600 mr-2"></i>
                        <span class="text-emerald-800 text-sm font-medium">Lokasi Kami</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Lokasi <span class="text-emerald-600">Strategis</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Terletak di kawasan pegunungan yang sejuk dengan pemandangan menakjubkan, mudah dijangkau dari berbagai kota besar di Jawa Barat</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <div class="bg-gray-200 rounded-2xl overflow-hidden shadow-lg h-[742px]">
                            <iframe src="{{ $setting->map_embed_url }}" class="w-full h-full" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi Hayya Syariah Glamping" style="border: 0px;"></iframe>
                        </div>
                        <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center">
                                    <i class="ri-map-pin-fill text-white"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $setting->name ?? 'Hayya Syariah Glamping' }}</div>
                                    <div class="text-sm text-gray-600">Pegunungan Bandung Barat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gradient-to-br from-emerald-50 to-amber-50 rounded-2xl p-8 mb-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Alamat Lengkap</h3>
                            <div class="space-y-4 mb-6">
                                <div class="flex items-start space-x-3">
                                    <i class="ri-map-pin-2-line text-emerald-600 text-xl mt-1"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Alamat</div>
                                        <div class="text-gray-600">{{ $setting->address }}</div>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="ri-phone-line text-emerald-600 text-xl mt-1"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Telepon</div>
                                        <div class="text-gray-600">{{ $setting->phone }}</div>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="ri-mail-line text-emerald-600 text-xl mt-1"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Email</div>
                                        <div class="text-gray-600">{{ $setting->email }}</div>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="ri-time-line text-emerald-600 text-xl mt-1"></i>
                                    <div>
                                        <div class="font-semibold text-gray-800">Check-in / Check-out</div>
                                        <div class="text-gray-600">14:00 - 12:00 WIB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <a href="https://maps.app.goo.gl/ALMuhRoJdc6p2KVt7" target="_blank" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors cursor-pointer whitespace-nowrap">
                                    <i class="ri-navigation-line mr-2"></i>Buka Maps
                                </a>
                                <a href="tel:{{ $setting->phone ?? '+6281234567890' }}" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white py-3 px-4 rounded-lg font-semibold transition-colors cursor-pointer whitespace-nowrap">
                                    <i class="ri-phone-line mr-2"></i>Hubungi
                                </a>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center">
                                <i class="ri-building-line text-emerald-600 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-800">Dari Tawangmangu</div>
                                <div class="text-sm text-gray-600">45 menit berkendara</div>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center">
                                <i class="ri-plane-line text-emerald-600 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-800">Dari ....</div>
                                <div class="text-sm text-gray-600">3 jam berkendara</div>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center">
                                <i class="ri-gas-station-line text-emerald-600 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-800">SPBU Terdekat</div>
                                <div class="text-sm text-gray-600">5 menit</div>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center">
                                <i class="ri-hospital-line text-emerald-600 text-2xl mb-2"></i>
                                <div class="font-semibold text-gray-800">RS Terdekat</div>
                                <div class="text-sm text-gray-600">15 menit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-br from-emerald-50 to-white" id="reservasi">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-emerald-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-calendar-check-line text-emerald-600 mr-2"></i>
                        <span class="text-emerald-800 text-sm font-medium">Reservasi & Kontak</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Reservasi <span class="text-emerald-600">Sekarang</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Siapkan liburan spiritual keluarga Anda dengan reservasi cepat via WhatsApp.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Form Reservasi Cepat</h3>
                        <form id="reservasi-form" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input class="w-full px-4 py-3 border rounded-lg" placeholder="Masukkan nama lengkap" required type="text" name="name" id="initial-name">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. WhatsApp *</label>
                                    <input class="w-full px-4 py-3 border rounded-lg" placeholder="08123456789" required type="tel" name="phone" id="initial-phone">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Check-in *</label>
                                <input class="w-full px-4 py-3 border rounded-lg" required type="date" name="checkIn" id="initial-checkIn">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Check-out *</label>
                                <input class="w-full px-4 py-3 border rounded-lg" required type="date" name="checkOut" id="initial-checkOut">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan Tambahan</label>
                                <textarea name="message" rows="4" class="w-full px-4 py-3 border rounded-lg resize-none" placeholder="Permintaan khusus..." maxlength="500" id="initial-message"></textarea>
                                <div class="text-right text-xs text-gray-500 mt-1">0/500 karakter</div>
                            </div>
                            <button type="button" onclick="openReservationModal()" class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 w-full">
                                <i class="ri-whatsapp-line mr-2"></i>Lanjutkan Reservasi
                            </button>
                        </form>
                    </div>
                    <div>
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl p-8 text-white mb-8">
                            <h3 class="text-2xl font-bold mb-6">Hubungi Kami Langsung</h3>
                            <div class="space-y-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <i class="ri-whatsapp-line text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold">WhatsApp (24/7)</div>
                                        <div class="text-emerald-100">+62 812-3456-7890</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                        <i class="ri-phone-line text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold">Telepon</div>
                                        <div class="text-emerald-100">+62 22-8765-4321</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="reservationModal" class="modal">
    <div class="modal-content max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Detail Reservasi Glamping</h3>
            <button onclick="closeReservationModal()" class="text-gray-600 hover:text-gray-800">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        <form id="detail-reservasi-form" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan nama lengkap" required type="text" name="name" id="modal-name">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. WhatsApp *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="08123456789" required type="tel" name="phone" id="modal-phone">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat *</label>
                <textarea name="address" rows="3" class="w-full px-4 py-3 border rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Hari & Tanggal Check-in *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" required type="date" name="checkIn" id="modal-checkIn">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Check-out *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" required type="date" name="checkOut" id="modal-checkOut">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lama Menginap (Hari) *</label>
                <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan jumlah hari" required type="number" min="1" name="stayDuration">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Room *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan jumlah room" required type="number" min="1" name="roomCount">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Kamar *</label>
                    <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" name="glampingId" required>
                        <option value="">Pilih kamar</option>
                        @foreach($glampings as $glamping)
                        <option value="{{ $glamping->id }}" data-title="{{ $glamping->title }}" data-type="{{ $glamping->type }}" data-price="{{ $glamping->price }}">
                            {{ $glamping->title }} ({{ ucfirst($glamping->type) }}, Rp {{ number_format($glamping->price, 0, ',', '.') }}/malam)
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Dewasa *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan jumlah dewasa" required type="number" min="1" name="adultCount">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Anak & Usia</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: 2 anak, usia 5 & 7" type="text" name="childCount">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Extra Bed? *</label>
                <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" name="extraBed" required>
                    <option value="">Pilih opsi</option>
                    <option value="yes">Ya</option>
                    <option value="no">Tidak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Rombongan Apa?</label>
                <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: Keluarga, Teman" type="text" name="groupType">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Kendaraan</label>
                <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan jumlah kendaraan" type="number" min="0" name="vehicleCount">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Akun Instagram</label>
                <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="@username" type="text" name="instagram">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tarif Glamping (Rp) *</label>
                    <input class="w-full px-4 py-3 border rounded-lg bg-gray-100 focus:outline-none" placeholder="Tarif akan dihitung otomatis" required type="number" min="0" name="glampingRate" id="glampingRate" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">DP (Rp) *</label>
                    <input class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Masukkan jumlah DP" required type="number" min="0" name="downPayment">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Wisata Jeep Adventure</label>
                <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" name="jeepAdventure">
                    <option value="no">Tidak</option>
                    <option value="yes">Ya</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Paket BBQ Grill</label>
                <select class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" name="bbqGrill">
                    <option value="no">Tidak</option>
                    <option value="yes">Ya</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan Tambahan</label>
                <textarea name="message" rows="4" class="w-full px-4 py-3 border rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Permintaan khusus..." maxlength="500" id="modal-message"></textarea>
                <div class="text-right text-xs text-gray-500 mt-1">0/500 karakter</div>
            </div>
            <div class="bg-emerald-50 p-4 rounded-lg">
                <h4 class="text-sm font-semibold text-gray-800 mb-2">Catatan Penting</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><i class="ri-time-line mr-2"></i>Check-in: 14:00 WIB | Check-out: 12:00 WIB</li>
                    <li><i class="ri-information-line mr-2"></i>Khusus pasutri berdua, wajib mengirimkan foto buku nikah.</li>
                    <li><i class="ri-bank-line mr-2"></i>Transfer DP min. 50% ke BSI 7227259439 a.n. Naufal Aly Mas UD.</li>
                    <li><i class="ri-shield-check-line mr-2"></i>Villa di-keep setelah DP diterima. Jika belum, belum dianggap booking.</li>
                    <li><i class="ri-map-pin-line mr-2"></i>Alamat lengkap, shareloc, dan kontak penjaga villa dibagikan setelah pemesanan.</li>
                </ul>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeReservationModal()" class="font-medium rounded-lg px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800">Batal</button>
                <button type="submit" class="font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3">
                    <i class="ri-whatsapp-line mr-2"></i>Kirim Reservasi
                </button>
            </div>
        </form>
    </div>
</div>
            </div>
        </section>
        <section class="py-20 bg-gradient-to-br from-emerald-50 to-white" id="faq">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center bg-emerald-100 rounded-full px-4 py-2 mb-4">
                        <i class="ri-question-line text-emerald-600 mr-2"></i>
                        <span class="text-emerald-800 text-sm font-medium">FAQ</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        Pertanyaan <span class="text-emerald-600">Yang Sering Ditanya</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Temukan jawaban untuk pertanyaan-pertanyaan umum tentang layanan glamping syariah kami. Jika masih ada yang ingin ditanyakan, jangan ragu untuk menghubungi kami!</p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div class="space-y-4">
                        @foreach($faqs as $faq)
                        <div class="faq-item bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <button class="w-full px-6 py-6 text-left flex items-center justify-between hover:bg-emerald-50 transition-colors cursor-pointer">
                                <h3 class="font-bold text-lg text-gray-800 pr-4">{{ $faq->question }}</h3>
                                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0 transition-transform duration-300">
                                    <i class="ri-arrow-down-s-line text-emerald-600"></i>
                                </div>
                            </button>
                            <div class="faq-content transition-all duration-300 overflow-hidden max-h-0 opacity-0">
                                <div class="px-6 pb-6">
                                    <div class="h-px bg-gray-200 mb-4"></div>
                                    <p class="text-gray-600 leading-relaxed">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-12 bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-2xl p-8 text-center text-white">
                        <h3 class="text-2xl font-bold mb-4">Masih Ada Pertanyaan?</h3>
                        <p class="text-emerald-100 mb-6">Tim customer service kami siap membantu Anda 24/7 melalui WhatsApp</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition-colors cursor-pointer whitespace-nowrap">
                                <i class="ri-whatsapp-line mr-2"></i>Chat WhatsApp
                            </a>
                            <a href="tel:{{ $setting->phone ?? '+6281234567890' }}" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-full font-semibold transition-colors cursor-pointer whitespace-nowrap">
                                <i class="ri-phone-line mr-2"></i>Telepon Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="bg-gray-900 text-white">
            <div class="container mx-auto px-4 py-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">{{ $setting->name ?? 'Hayya Syariah Glamping' }}</h3>
                        <p class="text-gray-400 text-justify leading-relaxed">{{ $setting->description ?? 'Glamping syariah pertama di Indonesia, harmonis dengan alam dan nilai Islami.' }}</p>
                        <div class="flex space-x-3 mt-4">
                            <a href="#" class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="ri-instagram-line text-white"></i>
                            </a>
                            <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="ri-whatsapp-line text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 text-emerald-300">Quick Links</h4>
                        <ul class="space-y-3">
                            <li><a href="#tentang" class="text-gray-400 hover:text-emerald-300 transition-colors duration-200">Tentang Kami</a></li>
                            <li><a href="#fasilitas" class="text-gray-400 hover:text-emerald-300 transition-colors duration-200">Fasilitas</a></li>
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
        <div id="gallery-modal" class="modal">
            <div class="modal-content relative flex items-center justify-center max-w-4xl">
                <button onclick="closeGalleryModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-20">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
                <button onclick="prevGalleryItem()" class="absolute left-4 text-white hover:text-gray-300 transition-colors z-20">
                    <i class="ri-arrow-left-s-line text-3xl"></i>
                </button>
                <button onclick="nextGalleryItem()" class="absolute right-4 text-white hover:text-gray-300 transition-colors z-20">
                    <i class="ri-arrow-right-s-line text-3xl"></i>
                </button>
                <div id="gallery-modal-content" class="w-full h-full flex items-center justify-center"></div>
            </div>
        </div>
        <script>
            function openReservationModal() {
    const name = document.getElementById('initial-name').value;
    const phone = document.getElementById('initial-phone').value;
    const checkIn = document.getElementById('initial-checkIn').value;
    const checkOut = document.getElementById('initial-checkOut').value;
    const message = document.getElementById('initial-message').value;
    document.getElementById('modal-name').value = name;
    document.getElementById('modal-phone').value = phone;
    document.getElementById('modal-checkIn').value = checkIn;
    document.getElementById('modal-checkOut').value = checkOut;
    document.getElementById('modal-message').value = message;
    document.getElementById('reservationModal').classList.add('show');
    calculateGlampingRate();
}

function calculateGlampingRate() {
    const glampingSelect = document.querySelector('select[name="glampingId"]');
    const roomCountInput = document.querySelector('input[name="roomCount"]');
    const stayDurationInput = document.querySelector('input[name="stayDuration"]');
    const glampingRateInput = document.getElementById('glampingRate');
    const selectedOption = glampingSelect.options[glampingSelect.selectedIndex];
    const price = selectedOption ? Number(selectedOption.dataset.price) || 0 : 0;
    const roomCount = Number(roomCountInput.value) || 0;
    const stayDuration = Number(stayDurationInput.value) || 0;
    const glampingRate = price * roomCount * stayDuration;
    glampingRateInput.value = glampingRate > 0 ? glampingRate : '';
}

function submitReservationForm() {
    const form = document.getElementById('detail-reservasi-form');
    const formData = new FormData(form);
    const glampingSelect = form.querySelector('select[name="glampingId"]');
    const selectedOption = glampingSelect.options[glampingSelect.selectedIndex];
    const glampingTitle = selectedOption.dataset.title || 'Tidak dipilih';
    const glampingType = selectedOption.dataset.type || 'Tidak diketahui';
    const glampingPrice = selectedOption.dataset.price || '0';
    let message = `Halo, saya ingin reservasi glamping:\n\n`;
    message += `Nama: ${formData.get('name')}\n`;
    message += `No. WhatsApp: ${formData.get('phone')}\n`;
    message += `Alamat: ${formData.get('address')}\n`;
    message += `Check-in: ${formData.get('checkIn')}\n`;
    message += `Check-out: ${formData.get('checkOut')}\n`;
    message += `Lama Menginap: ${formData.get('stayDuration')} hari\n`;
    message += `Jumlah Room: ${formData.get('roomCount')}\n`;
    message += `Kamar: ${glampingTitle} (${glampingType}, Rp ${Number(glampingPrice).toLocaleString('id-ID')}/malam)\n`;
    message += `Jumlah Dewasa: ${formData.get('adultCount')}\n`;
    message += `Jumlah Anak & Usia: ${formData.get('childCount') || 'Tidak ada'}\n`;
    message += `Extra Bed: ${formData.get('extraBed')}\n`;
    message += `Rombongan: ${formData.get('groupType') || 'Tidak disebutkan'}\n`;
    message += `Jumlah Kendaraan: ${formData.get('vehicleCount') || '0'}\n`;
    message += `Akun Instagram: ${formData.get('instagram') || 'Tidak ada'}\n`;
    message += `Tarif Glamping: Rp ${Number(formData.get('glampingRate')).toLocaleString('id-ID')}\n`;
    message += `DP: Rp ${Number(formData.get('downPayment')).toLocaleString('id-ID')}\n`;
    message += `Wisata Jeep Adventure: ${formData.get('jeepAdventure')}\n`;
    message += `Paket BBQ Grill: ${formData.get('bbqGrill')}\n`;
    message += `Pesan Tambahan: ${formData.get('message') || 'Tidak ada'}\n`;
    message += `Catatan: Foto buku nikah akan dikirim via WhatsApp (khusus pasutri).`;
    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
    const marriageBook = formData.get('marriageBook');
    if (marriageBook && marriageBook.size > 0) {
        alert('Silakan kirim foto buku nikah langsung melalui WhatsApp setelah formulir terkirim.');
    }
    closeReservationModal();
}

function closeReservationModal() {
    document.getElementById('reservationModal').classList.remove('show');
}

function showFacilityModal(facilityId) {
    const facilities = JSON.parse('{{ json_encode($facilities) }}'.replace(/&quot;/g, '"'));
    const facility = facilities.find(f => f.id === parseInt(facilityId));
    if (!facility) {
        console.error('Fasilitas tidak ditemukan');
        return;
    }
    const modalContent = `
        <div class="space-y-6">
            <img src="${facility.primaryImage?.file_path ? '/storage/' + facility.primaryImage.file_path : '/images/placeholder.jpg'}" alt="${facility.name}" class="w-full h-64 object-cover rounded-lg">
            <h3 class="text-xl font-bold text-gray-800">${facility.name}</h3>
            <p class="text-gray-600">${facility.description}</p>
            ${facility.images && facility.images.length > 0 ? `
                <div class="grid grid-cols-2 gap-4">
                    ${facility.images.map(img => `
                        <img src="/storage/${img.file_path}" alt="${facility.name}" class="w-full h-32 object-cover rounded-lg">
                    `).join('')}
                </div>
            ` : ''}
        </div>
    `;
    const modalContentElement = document.getElementById('facility-modal-content');
    if (modalContentElement) {
        modalContentElement.innerHTML = modalContent;
        document.getElementById('facility-modal').classList.add('show');
    } else {
        console.error('Elemen facility-modal-content tidak ditemukan');
    }
}

function closeFacilityModal() {
    document.getElementById('facility-modal').classList.remove('show');
}

function showModal(content) {
    const modal = document.getElementById('modal-container');
    const modalInner = document.getElementById('modal-inner');
    modalInner.innerHTML = content;
    modal.classList.add('show');
}

function closeModal() {
    document.getElementById('modal-container').classList.remove('show');
}

let currentGalleryIndex = 0;
let currentGalleryItems = [];

function showGalleryModal(index, type) {
    currentGalleryIndex = index;
    currentGalleryItems = Array.from(document.querySelectorAll(`.gallery-item[data-type="${type}"]`));
    const item = currentGalleryItems[index];
    const isImage = item.getAttribute('data-type') === 'foto';
    const src = item.querySelector(isImage ? 'img' : 'video source').getAttribute('src');
    const title = item.querySelector('h3').textContent;
    const modalContent = `
        <div class="text-center">
            ${isImage ? `<img src="${src}" alt="${title}" class="w-full h-auto">` : `<video controls class="w-full h-auto"><source src="${src}" type="video/mp4"></video>`}
            <h3 class="text-white text-lg font-semibold mt-4">${title}</h3>
        </div>
    `;
    const galleryModal = document.getElementById('gallery-modal');
    const galleryModalContent = document.getElementById('gallery-modal-content');
    galleryModalContent.innerHTML = modalContent;
    galleryModal.classList.add('show');
}

function closeGalleryModal() {
    const galleryModal = document.getElementById('gallery-modal');
    galleryModal.classList.remove('show');
    const video = galleryModal.querySelector('video');
    if (video) video.pause();
}

function prevGalleryItem() {
    currentGalleryIndex = (currentGalleryIndex - 1 + currentGalleryItems.length) % currentGalleryItems.length;
    showGalleryModal(currentGalleryIndex, currentGalleryItems[currentGalleryIndex].getAttribute('data-type'));
}

function nextGalleryItem() {
    currentGalleryIndex = (currentGalleryIndex + 1) % currentGalleryItems.length;
    showGalleryModal(currentGalleryIndex, currentGalleryItems[currentGalleryIndex].getAttribute('data-type'));
}

document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    const visitKey = 'kunjungan_' + today;
    if (!localStorage.getItem(visitKey)) {
        localStorage.setItem(visitKey, 'true');
    }
    const navLinks = document.querySelectorAll('.nav-link');
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
                    const navMenu = document.querySelector('.lg\\:hidden.transition-all');
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
    const navToggle = document.querySelector('.lg\\:hidden.p-2.rounded-lg.text-white');
    const navMenu = document.querySelector('.lg\\:hidden.transition-all');
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            const isOpen = navMenu.classList.contains('max-h-0');
            navMenu.classList.toggle('max-h-0', !isOpen);
            navMenu.classList.toggle('max-h-screen', isOpen);
            navMenu.classList.toggle('opacity-0', !isOpen);
            navMenu.classList.toggle('opacity-100', isOpen);
        });
    }
    const testimoniItems = document.querySelectorAll('.testimoni-carousel-item');
    const testimoniDots = document.querySelectorAll('.testimoni-dots button');
    let currentTestimoni = 0;
    let autoPlayInterval = null;
    function showTestimoni(index) {
        testimoniItems.forEach((item, i) => {
            item.style.display = i === index ? 'block' : 'none';
            item.style.opacity = i === index ? '1' : '0';
            item.style.transition = 'opacity 0.5s ease-in-out';
        });
        testimoniDots.forEach((dot, i) => {
            dot.classList.toggle('bg-emerald-600', i === index);
            dot.classList.toggle('w-8', i === index);
            dot.classList.toggle('bg-gray-300', i !== index);
            dot.classList.toggle('w-3', i !== index);
        });
    }
    function nextTestimoni() {
        currentTestimoni = (currentTestimoni + 1) % testimoniItems.length;
        showTestimoni(currentTestimoni);
    }
    function startAutoPlay() {
        autoPlayInterval = setInterval(nextTestimoni, 5000);
    }
    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }
    testimoniDots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            stopAutoPlay();
            currentTestimoni = i;
            showTestimoni(currentTestimoni);
            startAutoPlay();
        });
    });
    if (testimoniItems.length) {
        showTestimoni(currentTestimoni);
        startAutoPlay();
        const testimoniSection = document.querySelector('#testimoni');
        if (testimoniSection) {
            testimoniSection.addEventListener('mouseenter', stopAutoPlay);
            testimoniSection.addEventListener('mouseleave', startAutoPlay);
        }
    }
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const button = item.querySelector('button');
        const content = item.querySelector('.faq-content');
        const icon = button.querySelector('i');
        button.addEventListener('click', () => {
            const isOpen = content.classList.contains('max-h-96');
            faqItems.forEach(other => {
                const otherContent = other.querySelector('.faq-content');
                const otherIcon = other.querySelector('i');
                otherContent.classList.remove('max-h-96', 'opacity-100');
                otherContent.classList.add('max-h-0', 'opacity-0');
                otherIcon.classList.remove('rotate-180');
            });
            if (!isOpen) {
                content.classList.add('max-h-96', 'opacity-100');
                content.classList.remove('max-h-0', 'opacity-0');
                icon.classList.add('rotate-180');
            }
        });
    });
    const tabButtons = document.querySelectorAll('.tab-button');
    const galleryItems = document.querySelectorAll('.gallery-item');
    let currentTab = 'foto';
    const initialVisibleCount = 3;
    const loadMoreCount = 3;
    let currentVisibleCount = initialVisibleCount;
    function showGalleryItems() {
        const activeTab = document.querySelector('.tab-button.bg-emerald-600')?.getAttribute('data-tab') || 'foto';
        galleryItems.forEach(item => {
            item.style.display = 'none';
        });
        let visibleCount = 0;
        galleryItems.forEach(item => {
            if (item.getAttribute('data-type') === activeTab && visibleCount < currentVisibleCount) {
                item.style.display = 'block';
                visibleCount++;
            }
        });
        const totalItemsOfActiveType = document.querySelectorAll(`.gallery-item[data-type="${activeTab}"]`).length;
        const loadMoreButton = document.getElementById('load-more-gallery');
        if (currentVisibleCount >= totalItemsOfActiveType) {
            loadMoreButton.style.display = 'none';
        } else {
            loadMoreButton.style.display = 'inline-flex';
        }
    }
    tabButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            tabButtons.forEach(btn => {
                btn.classList.remove('bg-emerald-600', 'text-white');
                btn.classList.add('text-gray-600', 'hover:text-emerald-600');
            });
            button.classList.add('bg-emerald-600', 'text-white');
            button.classList.remove('text-gray-600', 'hover:text-emerald-600');
            currentTab = button.getAttribute('data-tab');
            currentVisibleCount = initialVisibleCount;
            showGalleryItems();
        });
    });
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            const type = item.getAttribute('data-type');
            showGalleryModal(index, type);
        });
    });
    const loadMoreButton = document.getElementById('load-more-gallery');
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', () => {
            currentVisibleCount += loadMoreCount;
            showGalleryItems();
        });
    }
    showGalleryItems();
    document.addEventListener('keydown', (e) => {
        if (document.getElementById('gallery-modal').classList.contains('show')) {
            if (e.key === 'ArrowLeft') prevGalleryItem();
            if (e.key === 'ArrowRight') nextGalleryItem();
            if (e.key === 'Escape') closeGalleryModal();
        }
    });
    const reservasiForm = document.getElementById('reservasi-form');
    if (reservasiForm) {
        const messageInput = reservasiForm.querySelector('textarea[name="message"]');
        const charCount = reservasiForm.querySelector('.text-right.text-xs.text-gray-500');
        messageInput.addEventListener('input', () => {
            const count = messageInput.value.length;
            charCount.textContent = `${count}/500 karakter`;
        });
        reservasiForm.addEventListener('submit', (e) => {
            e.preventDefault();
            openReservationModal();
        });
    }
    const detailReservasiForm = document.getElementById('detail-reservasi-form');
    if (detailReservasiForm) {
        const modalMessageInput = detailReservasiForm.querySelector('textarea[name="message"]');
        const modalCharCount = detailReservasiForm.querySelector('.text-right.text-xs.text-gray-500');
        modalMessageInput.addEventListener('input', () => {
            const count = modalMessageInput.value.length;
            modalCharCount.textContent = `${count}/500 karakter`;
        });
        const glampingSelect = detailReservasiForm.querySelector('select[name="glampingId"]');
        const roomCountInput = detailReservasiForm.querySelector('input[name="roomCount"]');
        const stayDurationInput = detailReservasiForm.querySelector('input[name="stayDuration"]');
        glampingSelect.addEventListener('change', calculateGlampingRate);
        roomCountInput.addEventListener('input', calculateGlampingRate);
        stayDurationInput.addEventListener('input', calculateGlampingRate);
        detailReservasiForm.addEventListener('submit', (e) => {
            e.preventDefault();
            calculateGlampingRate();
            submitReservationForm();
        });
    }
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('nav');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
    const facilityButtons = document.querySelectorAll('button[onclick^="showFacilityModal"]');
    facilityButtons.forEach(button => {
        button.addEventListener('click', () => {
            const facilityId = button.getAttribute('onclick').match(/\d+/)[0];
            showFacilityModal(facilityId);
        });
    });
});
        </script>
</html>