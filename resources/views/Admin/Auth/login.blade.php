<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hayya Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .shadow-glow {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .hover-scale {
            transition: transform 0.2s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="absolute inset-0 opacity-5">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="relative w-full max-w-md">
        <div id="errorMessage" class="hidden fixed top-4 right-4 bg-red-500 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-lg transition-all duration-500 transform translate-x-full">
            Kredensial tidak sesuai. Silakan coba lagi.
        </div>

        <div class="text-center mb-6">
            @php
                $settings = App\Models\Setting::first();
            @endphp
            @if ($settings && $settings->logo)
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="Hayya Admin Logo" class="mx-auto h-16 mb-4 rounded-full object-cover">
            @else
                <img src="{{ asset('images/default-logo.png') }}" alt="Aaas" class="mx-auto h-16 mb-4 rounded-full object-cover">
            @endif
            <h1 class="text-xl font-semibold text-gray-800">Hayya Admin</h1>
            <p class="text-gray-600 text-sm">Kelola peminjaman dengan mudah</p>
        </div>

        <div class="bg-white rounded-lg shadow-glow p-6">
            <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="nama@gmail.com" required>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-10 py-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700" placeholder="Kata sandi" required>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-green-700 focus:ring-green-700 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-green-700 hover:underline">Lupa kata sandi?</a>
                </div>

                <button type="submit" id="loginButton" class="w-full bg-green-700 text-white py-2 rounded-lg font-medium hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span id="loginButtonText">Masuk</span>
                </button>
            </form>
            
            <p class="text-center text-xs text-gray-600 mt-6">© {{ date('Y') }} Hayya Admin. Hak cipta dilindungi.</p>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const errorMessage = document.getElementById('errorMessage');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.innerHTML = type === 'text' ? 
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        });

        @if ($errors->has('email'))
            errorMessage.textContent = "{{ $errors->first('email') }}";
            errorMessage.classList.remove('hidden', 'translate-x-full');
            errorMessage.classList.add('translate-x-0', 'opacity-100');
            setTimeout(() => {
                errorMessage.classList.remove('translate-x-0', 'opacity-100');
                errorMessage.classList.add('translate-x-full');
                setTimeout(() => errorMessage.classList.add('hidden'), 500);
            }, 3000);
        @endif

        @if (session('success'))
            errorMessage.textContent = "{{ session('success') }}";
            errorMessage.classList.remove('bg-red-500');
            errorMessage.classList.add('bg-green-600');
            errorMessage.classList.remove('hidden', 'translate-x-full');
            errorMessage.classList.add('translate-x-0', 'opacity-100');
            setTimeout(() => {
                errorMessage.classList.remove('translate-x-0', 'opacity-100');
                errorMessage.classList.add('translate-x-full');
                setTimeout(() => errorMessage.classList.add('hidden'), 500);
            }, 3000);
        @endif
    </script>
</body>
</html>