<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stay Home - Premium Staycation Experience')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F8F5F0',
                        navy: '#1E2B45',
                        gold: '#C6A972',
                        'gray-light': '#E5E5E5',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,h5 { font-family: 'Playfair Display', serif; }
        .sticky-header { transition: all 0.3s ease; backdrop-filter: blur(10px); }
        .sticky-header.sticky { background-color: rgba(30, 43, 69, 0.95); box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .facility-card { transition: all 0.3s ease; overflow: hidden; }
        .facility-card:hover { transform: translateY(-5px); }
        .facility-card:hover .facility-icon { transform: scale(1.1); color: #C6A972; }
        .room-card:hover .room-image { transform: scale(1.05); }
        .booking-form { box-shadow: 0 15px 40px rgba(30,43,69,0.1); }
        .gold-line { height: 2px; width: 60px; background-color: #C6A972; margin: 15px auto; }
        .section-padding { padding: 100px 0; }
        @media (max-width: 768px) {
            .section-padding { padding: 60px 0; }
            .hero-section { height: 80vh; }
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-navy bg-cream">
    @include('layouts.partials.navbar')
    <main>
        @yield('content')
    </main>
    @include('layouts.partials.footer')
    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.sticky-header');
            if (window.scrollY > 50) header.classList.add('sticky');
            else header.classList.remove('sticky');
        });
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({ top: targetElement.offsetTop - 100, behavior: 'smooth' });
                }
            });
        });
        document.querySelector('button.md\\:hidden')?.addEventListener('click', () => {
            alert('Menu mobile akan ditampilkan di sini');
        });
    </script>
    @stack('scripts')
</body>
</html>
