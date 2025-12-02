<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <title>{{ $setting->name ?? 'Hayya Syariah Glamping' }} - Kamar Glamping Syariah</title>
    <meta name="description" content="Glamping syariah premium di Lembang dengan mushola pribadi, fasilitas halal, dan pemandangan alam indah untuk keluarga Muslim.">
    <meta name="keywords" content="glamping syariah, penginapan halal, lembang, bandung, mushola pribadi">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.min.css">
    <style>
        .hero-section{background:linear-gradient(rgba(0,0,0,0.68),rgba(0,0,0,0.68)),url('/storage/images/gallery/img/galeri1.jpg') center/cover no-repeat fixed;min-height:100vh}
        @media(max-width:768px){.hero-section{background-attachment:scroll}}
        .navbar-scrolled{background:rgba(255,255,255,0.98);backdrop-filter:blur(12px);box-shadow:0 4px 30px rgba(0,0,0,0.12)}
        .navbar-scrolled .text-white{color:#065f46 !important}
        .navbar-scrolled .hover\:text-emerald-600:hover{color:#10b981 !important}
        .navbar-scrolled .hubungi{color:#10b981 !important;border-color:#10b981 !important}
        .navbar-scrolled .reservasi{background:#10b981 !important}
        .glamping-card{transition:all .4s ease}
        .glamping-card:hover{transform:translateY(-12px);box-shadow:0 30px 60px rgba(0,0,0,0.18)}
        .glamping-card:hover img{transform:scale(1.08)}
        .modal{display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.88);backdrop-filter:blur(12px);align-items:center;justify-content:center;padding:1rem}
        .modal.show{display:flex}
        .modal-content{background:white;border-radius:28px;max-width:1100px;width:100%;max-height:95vh;overflow-y:auto;box-shadow:0 50px 100px rgba(0,0,0,0.35)}
        .filter-btn.active{background:#10b981;color:white;box-shadow:0 8px 25px rgba(16,185,129,0.45)}
        .mobile-menu{transition:all .4s ease;max-height:0;opacity:0;overflow:hidden}
        .mobile-menu.open{max-height:800px;opacity:1}
    </style>
</head>
<body class="bg-gray-50">
<div id="root">
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 overflow-hidden rounded-full">
                        <img src="{{ asset('storage/'.$setting->logo) }}" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="font-bold text-lg text-white">{{ $setting->name ?? 'Hayya Syariah' }}</div>
                        <div class="text-sm text-emerald-300">Glamping Islami</div>
                    </div>
                </div>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home.index') }}" class="font-medium text-white hover:text-emerald-400 transition">Home</a>
                    <a href="{{ route('home.kamar') }}" class="font-medium text-emerald-400">Kamar</a>
                    <a href="{{ route('home.index') }}#fasilitas" class="font-medium text-white hover:text-emerald-400 transition">Fasilitas</a>
                    <a href="{{ route('home.index') }}#galeri" class="font-medium text-white hover:text-emerald-400 transition">Galeri</a>
                    <a href="{{ route('home.index') }}#tentang" class="font-medium text-white hover:text-emerald-400 transition">Tentang</a>
                </div>
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="tel:{{ $setting->phone ?? '+6281234567890' }}" class="hubungi font-medium rounded-lg flex items-center border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-6 py-3 transition">
                        <i class="ri-phone-line mr-2"></i>Hubungi
                    </a>
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Halo,%20saya%20ingin%20reservasi" class="reservasi font-medium rounded-lg flex items-center bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 transition">
                        <i class="ri-whatsapp-line mr-2"></i>Reservasi
                    </a>
                </div>
                <button id="menu-toggle" class="lg:hidden p-3 rounded-lg text-white hover:bg-white/10">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>
            <div id="mobile-menu" class="lg:hidden mobile-menu">
                <div class="bg-white/95 backdrop-blur rounded-2xl shadow-2xl mt-2 py-6 px-6 space-y-4">
                    <a href="{{ route('home.index') }}" class="block text-gray-700 hover:text-emerald-600 font-medium py-2">Home</a>
                    <a href="{{ route('home.kamar') }}" class="block text-emerald-600 font-bold py-2">Kamar</a>
                    <a href="{{ route('home.index') }}#fasilitas" class="block text-gray-700 hover:text-emerald-600 font-medium py-2">Fasilitas</a>
                    <a href="{{ route('home.index') }}#galeri" class="block text-gray-700 hover:text-emerald-600 font-medium py-2">Galeri</a>
                    <a href="{{ route('home.index') }}#tentang" class="block text-gray-700 hover:text-emerald-600 font-medium py-2">Tentang</a>
                    <div class="pt-4 border-t border-gray-200">
                        <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-medium">
                            <i class="ri-whatsapp-line mr-2"></i> Reservasi WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">Kamar Glamping Syariah</h1>
            <p class="text-xl md:text-2xl max-w-4xl mx-auto mb-10 opacity-95 leading-relaxed">
                Pengalaman menginap halal nan mewah dengan mushola pribadi, kiblat, dan ketenangan sejati di tengah alam Lembang.
            </p>
            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="#glamping" class="bg-emerald-600 hover:bg-emerald-700 text-white px-10 py-5 rounded-full font-bold text-lg shadow-2xl transition transform hover:scale-105">
                    <i class="ri-eye-line mr-2"></i> Lihat Kamar
                </a>
                <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Assalamu'alaikum,%20saya%20ingin%20reservasi" class="border-2 border-white text-white hover:bg-white hover:text-emerald-700 px-10 py-5 rounded-full font-bold text-lg transition">
                    <i class="ri-whatsapp-line mr-2"></i> Reservasi Langsung
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white" id="glamping">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block bg-emerald-100 text-emerald-700 px-6 py-3 rounded-full font-bold mb-5">
                    <i class="ri-tent-line mr-2"></i> Koleksi Glamping Kami
                </span>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">
                    Pilih <span class="text-emerald-600">Hunian Impian</span> Anda
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Setiap tenda dirancang sesuai syariat dengan fasilitas premium.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="filter-btn active px-8 py-3 rounded-full font-bold transition" data-filter="all">Semua</button>
                <button class="filter-btn px-8 py-3 rounded-full font-bold border border-emerald-300 transition" data-filter="available">Tersedia</button>
                <button class="filter-btn px-8 py-3 rounded-full font-bold border border-emerald-300 transition" data-filter="standard">Standard</button>
                <button class="filter-btn px-8 py-3 rounded-full font-bold border border-emerald-300 transition" data-filter="deluxe">Deluxe</button>
                <button class="filter-btn px-8 py-3 rounded-full font-bold border border-emerald-300 transition" data-filter="family">Keluarga</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($glampings as $glamping)
                <div class="glamping-card block rounded-2xl overflow-hidden shadow-2xl bg-white" data-status="{{ $glamping->status }}" data-type="{{ strtolower($glamping->type) }}">
                    <div class="relative">
                        <img src="{{ $glamping->images->first()?->image_path ? asset('storage/'.$glamping->images->first()->image_path) : asset('images/placeholder.jpg') }}" alt="{{ $glamping->title }}" class="w-full h-80 object-cover transition-transform duration-700">
                        <div class="absolute top-4 right-4">
                            <span class="px-5 py-2 rounded-full text-white font-bold {{ $glamping->status == 'available' ? 'bg-emerald-600' : 'bg-red-600' }}">
                                {{ $glamping->status == 'available' ? 'Tersedia' : 'Penuh' }}
                            </span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white">
                            <h3 class="text-2xl font-bold">{{ $glamping->title }}</h3>
                            <p class="text-sm opacity-90 flex items-center mt-1"><i class="ri-map-pin-line mr-1"></i> Lembang, Bandung</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between mb-4 text-gray-600">
                            <span><i class="ri-user-line text-emerald-600"></i> {{ $glamping->capacity }} Tamu</span>
                            <span><i class="ri-hotel-bed-line text-emerald-600"></i> {{ $glamping->beds }} Bed</span>
                        </div>
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <span class="text-3xl font-bold text-emerald-600">Rp {{ number_format($glamping->price, 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-sm">/ malam</span>
                            </div>
                            <div class="flex text-amber-500 text-xl">
                                @for($i=1;$i<=5;$i++)
                                    <i class="ri-star-fill {{ $i<=$glamping->rating ? '' : 'opacity-30' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <button onclick="showGlampingModal({{ json_encode($glamping) }})" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-full font-bold transition shadow-xl">
                            <i class="ri-eye-line mr-2"></i> Lihat Detail
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20">
                    <i class="ri-tent-line text-9xl text-gray-200 mb-6"></i>
                    <h3 class="text-3xl font-bold text-gray-500">Belum ada kamar tersedia</h3>
                    <p class="text-gray-400 mt-3">InsyaAllah segera hadir dengan keindahan yang lebih sempurna.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-br from-emerald-50 to-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-amber-100 text-amber-700 rounded-full px-6 py-3 mb-5 font-bold">
                    <i class="ri-information-line mr-2"></i> Mengapa Memilih Kami
                </div>
                <h2 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">
                    Keunggulan <span class="text-emerald-600">Kamar Syariah</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Nikmati pengalaman menginap yang nyaman, halal, dan penuh berkah di tengah alam indah.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition text-center">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-shield-check-line text-5xl text-emerald-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">100% Syariah Compliant</h3>
                    <p class="text-gray-600">Mushola pribadi, arah kiblat, makanan halal, dan segala fasilitas sesuai ajaran Islam.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition text-center">
                    <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-leaf-line text-5xl text-amber-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Ramah Lingkungan</h3>
                    <p class="text-gray-600">Material eco-friendly, hemat energi, dan menyatu harmonis dengan alam pegunungan.</p>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition text-center">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-star-line text-5xl text-emerald-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Fasilitas Premium</h3>
                    <p class="text-gray-600">AC, WiFi kencang, kamar mandi dalam, kitchenette, dan view kebun teh yang menakjubkan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-6">Siap Mengalami Glamping Syariah?</h2>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-12 opacity-95">
                Reservasi sekarang dan nikmati kenyamanan akomodasi halal dengan pemandangan alam terbaik di Lembang.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Assalamu'alaikum,%20saya%20ingin%20reservasi%20glamping%20syariah" class="bg-white text-emerald-700 hover:bg-gray-100 px-10 py-6 rounded-full font-bold text-xl shadow-2xl transition transform hover:scale-105">
                    <i class="ri-whatsapp-line mr-3 text-2xl"></i> Reservasi via WhatsApp
                </a>
                <a href="tel:{{ $setting->whatsapp_number ?? '+6281234567890' }}" class="border-4 border-white text-white hover:bg-white hover:text-emerald-700 px-10 py-6 rounded-full font-bold text-xl transition">
                    <i class="ri-phone-line mr-3 text-2xl"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-20">
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
                        <li class="flex items-center space-x-2"><i class="ri-check-line text-emerald-400"></i><span>Glamping Syariah</span></li>
                        <li class="flex items-center space-x-2"><i class="ri-check-line text-emerald-400"></i><span>Halal Food & Beverage</span></li>
                        <li class="flex items-center space-x-2"><i class="ri-check-line text-emerald-400"></i><span>Alam Asri & Ramah Lingkungan</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800">
            <div class="container mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                <div>© 2025 Hayya Syariah Glamping. All rights reserved.</div>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-emerald-300 transition-colors duration-200">Privacy Policy</a>
                    <a href="#" class="hover:text-emerald-300 transition-colors duration-200">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="modal-container" class="modal" onclick="if(event.target===this)closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div id="modal-inner" class="relative"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    const navbar=document.querySelector('nav');
    const menuToggle=document.getElementById('menu-toggle');
    const mobileMenu=document.getElementById('mobile-menu');

    menuToggle.addEventListener('click',()=>{mobileMenu.classList.toggle('open')});

    window.addEventListener('scroll',()=>{navbar.classList.toggle('navbar-scrolled',window.scrollY>50)});

    document.querySelectorAll('a[href^="#"],a[href*="#"]').forEach(a=>{
        a.addEventListener('click',function(e){
            const href=this.getAttribute('href');
            if(href.includes('#')&&!href.includes('://')){
                const id=href.split('#')[1];
                const target=document.getElementById(id);
                if(target){
                    e.preventDefault();
                    const offset=navbar.offsetHeight+20;
                    window.scrollTo({top:target.offsetTop-offset,behavior:'smooth'});
                    if(mobileMenu.classList.contains('open'))mobileMenu.classList.remove('open');
                }
            }
        });
    });

    document.querySelectorAll('.filter-btn').forEach(btn=>{
        btn.addEventListener('click',function(){
            document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
            this.classList.add('active');
            const f=this.dataset.filter;
            document.querySelectorAll('.glamping-card').forEach(c=>{
                const s=c.dataset.status;
                const t=c.dataset.type;
                c.style.display=(f==='all'||(f==='available'&&s==='available')||(f!=='available'&&t===f))?'block':'none';
            });
        });
    });
});

function showGlampingModal(g){
    document.getElementById('modal-inner').innerHTML=`
        <button onclick="closeModal()" class="absolute top-6 right-6 z-50 w-16 h-16 bg-white rounded-full shadow-2xl flex items-center justify-center hover:bg-red-50 transition">
            <i class="ri-close-line text-4xl text-gray-700"></i>
        </button>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="relative overflow-hidden">
                <img src="${g.images?.[0]?.image_path?'/storage/'+g.images[0].image_path:'/images/placeholder.jpg'}" class="w-full h-96 lg:h-full object-cover" alt="${g.title}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-10 left-10 text-white">
                    <h3 class="text-5xl font-bold mb-3">${g.title}</h3>
                    <p class="text-xl flex items-center"><i class="ri-map-pin-line mr-2"></i> Lembang, Bandung</p>
                </div>
            </div>
            <div class="p-10 lg:p-16">
                <div class="flex justify-between items-start mb-12">
                    <p class="text-5xl font-bold text-emerald-600">Rp ${new Intl.NumberFormat('id-ID').format(g.price)}<span class="text-xl text-gray-500"> / malam</span></p>
                    <div class="flex text-amber-500 text-4xl">${'★'.repeat(g.rating)+'☆'.repeat(5-g.rating)}</div>
                </div>
                <div class="grid grid-cols-2 gap-10 mb-12">
                    <div class="bg-emerald-50 p-8 rounded-3xl text-center">
                        <p class="text-gray-600 mb-3 text-lg">Kapasitas</p>
                        <p class="text-4xl font-bold text-emerald-700">${g.capacity} Tamu</p>
                    </div>
                    <div class="bg-emerald-50 p-8 rounded-3xl text-center">
                        <p class="text-gray-600 mb-3 text-lg">Tempat Tidur</p>
                        <p class="text-4xl font-bold text-emerald-700">${g.beds} Unit</p>
                    </div>
                </div>
                <p class="text-gray-700 text-lg leading-relaxed mb-12">${g.description||'Kamar nyaman dengan fasilitas lengkap, mushola pribadi, dan pemandangan alam yang memukau.'}</p>
                <a href="https://wa.me/{{ $setting->whatsapp_number ?? '+6281234567890' }}?text=Assalamu'alaikum,%20saya%20tertarik%20dengan%20*${encodeURIComponent(g.title)}*%20seharga%20Rp%20${g.price.toLocaleString('id-ID')}%20per%20malam.%20Mohon%20info%20ketersediaan." class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white py-7 rounded-full font-bold text-2xl shadow-2xl transition transform hover:scale-105">
                    <i class="ri-whatsapp-line mr-4 text-3xl"></i> Reservasi Sekarang via WhatsApp
                </a>
            </div>
        </div>`;
    document.getElementById('modal-container').classList.add('show');
    document.body.style.overflow='hidden';
}
function closeModal(){
    document.getElementById('modal-container').classList.remove('show');
    document.body.style.overflow='auto';
}
</script>
</body>
</html>