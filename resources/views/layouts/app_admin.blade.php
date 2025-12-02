<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Hayya Syariah</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            emerald: {
              50: '#f0fdfa',
              100: '#ccfbf1',
              200: '#99f6e4',
              300: '#5eead4',
              400: '#2dd4bf',
              500: '#14b8a6',
              600: '#0d9488',
              700: '#0f766e',
              800: '#115e59',
              900: '#134e4a',
            },
            neutral: {
              50: '#f8fafc',
              100: '#f1f5f9',
              200: '#e2e8f0',
              300: '#cbd5e1',
              400: '#94a3b8',
              500: '#64748b',
              600: '#475569',
              700: '#334155',
              800: '#1e293b',
              900: '#0f172a',
            },
            accent: {
              blue: '#3b82f6',
              amber: '#f59e0b',
              red: '#ef4444',
            }
          },
          animation: {
            'fade-in': 'fadeIn 0.5s ease-out',
            'slide-in': 'slideIn 0.3s ease-out',
            'scale-in': 'scaleIn 0.2s ease-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideIn: {
              '0%': { transform: 'translateY(10px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' },
            },
            scaleIn: {
              '0%': { transform: 'scale(0.95)', opacity: '0' },
              '100%': { transform: 'scale(1)', opacity: '1' },
            }
          },
          boxShadow: {
            'soft': '0 4px 16px rgba(0, 0, 0, 0.05)',
            'softer': '0 8px 24px rgba(0, 0, 0, 0.08)',
          },
          fontFamily: {
            inter: ['Inter', 'sans-serif'],
          },
        }
      }
    }
  </script>
  <style>
    body { 
      font-family: 'Inter', sans-serif;
      font-size: 15px;
      line-height: 1.6;
    }
    .nav-item.active {
      background: linear-gradient(135deg, rgba(20, 184, 166, 0.1) 0%, rgba(13, 148, 136, 0.05) 100%);
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.1);
      position: relative;
      border-radius: 0.75rem;
    }
    .nav-item.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background: linear-gradient(to bottom, #14b8a6, #0d9488);
      border-radius: 4px 0 0 4px;
    }
    .glass-effect {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .sidebar-glass {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-right: 1px solid rgba(255, 255, 255, 0.2);
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(13, 148, 136, 0.1);
    }
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: 50;
      align-items: center;
      justify-content: center;
    }
    .modal.show {
      display: flex;
    }
    .modal-content {
      max-width: 640px;
      width: 90%;
      max-height: 85vh;
      overflow-y: auto;
      border-radius: 1rem;
      animation: scaleIn 0.2s ease-out;
    }
    .table-row-hover:hover {
      background-color: rgba(20, 184, 166, 0.05);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(13, 148, 136, 0.08);
    }
  </style>
</head>
<body class="bg-neutral-50 min-h-screen text-neutral-800 flex">
  <!-- Sidebar -->
  <aside class="w-80 sidebar-glass shadow-soft flex flex-col fixed inset-y-0 z-10">
  <div class="p-6 border-b  border-neutral-200/50 flex items-center">
      <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 flex items-center justify-center shadow-soft mr-3">
          <img src="{{ asset('storage/' . $setting->logo) }}" 
              alt="Hayya Admin Logo" 
              class="h-10 w-10 object-cover rounded-md">
      </div>
      <div class="flex flex-col">
          <h1 class="text-2xl font-semibold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent leading-none">
              Hayya Admin
          </h1>
          <span class="text-[10px] text-emerald-600 font-medium tracking-widest uppercase mt-0.5">
              Administrasi Utama Hayya 
          </span>
      </div>
  </div>
        <nav class="flex-1 p-4 space-y-1 mt-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-house text-sm"></i>
                </div>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.facilities.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.facilities.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-building text-sm"></i>
                </div>
                <span class="font-medium">Fasilitas</span>
            </a>
            <a href="{{ route('admin.packages.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.packages.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-box text-sm"></i>
                </div>
                <span class="font-medium">Paket</span>
            </a>
            <a href="{{ route('admin.glampings.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.glampings.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-tent text-sm"></i>
                </div>
                <span class="font-medium">Glamping</span>
            </a>
            <a href="{{ route('admin.gallery_items.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.gallery_items.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-image text-sm"></i>
                </div>
                <span class="font-medium">Galeri</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.testimonials.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-comments text-sm"></i>
                </div>
                <span class="font-medium">Testimoni</span>
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.faqs.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-circle-question text-sm"></i>
                </div>
                <span class="font-medium">FAQ</span>
            </a>
            <a href="{{ route('admin.users.index') }}" 
                class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.users.*') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                  <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                      <i class="fa-solid fa-users text-sm"></i>
                  </div>
                  <span class="font-medium">Pengguna</span>
              </a>
            <a href="{{ route('admin.settings.index') }}" class="nav-item flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.settings.index') ? 'bg-emerald-100 text-emerald-700 font-semibold' : 'hover:bg-emerald-50' }}">
                <div class="w-9 h-9 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-xl mr-3 shadow-sm">
                    <i class="fa-solid fa-gear text-sm"></i>
                </div>
                <span class="font-medium">Pengaturan</span>
            </a>
        </nav>
        <div class="p-4 border-t border-neutral-200/50 text-xs text-neutral-500 flex justify-between items-center">
            <span>© 2025 Hayya Syariah</span>
            <span class="text-emerald-600">v2.1.0</span>
        </div>
    </aside>

  <div class="flex-1 ml-80 flex flex-col min-h-screen">
    <header class="glass-effect border-b border-neutral-200/50 p-5 flex justify-between items-center sticky top-0 z-10">
      <div>
        <h2 class="text-xl font-semibold text-neutral-700">Halaman Admin</h2>
        <p class="text-sm text-neutral-500 mt-1">Selamat datang kembali, Admin!</p>
      </div>
      <div class="flex items-center space-x-4">
        <div class="relative">
          <button class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-soft hover:shadow-softer transition-all">
            <i class="fa-solid fa-bell"></i>
          </button>
          <span class="absolute -top-1 -right-1 w-4 h-4 bg-accent-red rounded-full text-xs text-white flex items-center justify-center">3</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-gradient-to-r from-emerald-500 to-emerald-400 text-white px-4 py-2.5 rounded-xl hover:shadow-softer transition-all flex items-center space-x-2">
            <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </header>

    <main class="flex-1 p-8">
      <!-- Breadcrumb -->
      <div class="flex items-center text-sm text-neutral-500 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors">Dashboard</a>
        <i class="fa-solid fa-chevron-right mx-2 text-xs"></i>
        <span class="text-emerald-600">@yield('title', 'Halaman')</span>
      </div>
      
      <!-- Page Content -->
      <div class="glass-effect rounded-2xl border border-neutral-200/50 shadow-soft p-6 animate-slide-in">
        @yield('content')
      </div>
    </main>
  </div>

  <div id="modal-container" class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-content glass-effect shadow-softer">
      <div id="modal-content-inner"></div>
    </div>
  </div>

  @stack('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const currentPage = window.location.pathname;
      const navItems = document.querySelectorAll('.nav-item');
      
      navItems.forEach(item => {
        if (item.getAttribute('href') === currentPage) {
          item.classList.add('active');
        }
        
        item.addEventListener('mouseenter', function() {
          this.style.transform = 'translateX(4px)';
        });
        item.addEventListener('mouseleave', function() {
          this.style.transform = 'translateX(0)';
        });
      });

      // Modal handling
      const modal = document.getElementById('modal-container');
      const modalContent = document.getElementById('modal-content-inner');

      window.showModal = function(content) {
        modalContent.innerHTML = content;
        modal.classList.add('show');
        // Trap focus inside modal
        const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea');
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        modal.addEventListener('keydown', function(e) {
          if (e.key === 'Tab') {
            if (e.shiftKey && document.activeElement === firstElement) {
              e.preventDefault();
              lastElement.focus();
            } else if (!e.shiftKey && document.activeElement === lastElement) {
              e.preventDefault();
              firstElement.focus();
            }
          }
        });
        firstElement.focus();
      };

      window.closeModal = function() {
        modal.classList.remove('show');
        modalContent.innerHTML = '';
      };

      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          closeModal();
        }
      });
    });

    
  </script>
</body>
</html>