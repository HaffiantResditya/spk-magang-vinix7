<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SPK Vinix7') }} | PT Vinix Seven Aurum</title>

        <!-- Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-slate-800 antialiased min-h-full bg-gradient-to-br from-vinix-navy via-slate-900 to-blue-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <a href="/" class="inline-flex items-center space-x-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-vinix-aurum to-amber-300 flex items-center justify-center font-black text-slate-950 text-2xl shadow-xl group-hover:scale-105 transition-transform">
                    7
                </div>
                <div class="text-left">
                    <span class="text-2xl font-black tracking-wider text-white">VINIX<span class="text-vinix-aurum">7</span></span>
                    <span class="text-[11px] text-blue-200 block uppercase tracking-widest font-semibold">PT Vinix Seven Aurum</span>
                </div>
            </a>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-2xl rounded-3xl sm:px-10 border border-slate-100">
                {{ $slot }}
            </div>
            <div class="text-center mt-6">
                <a href="/" class="text-xs font-semibold text-blue-200 hover:text-white transition">
                    &larr; Kembali ke Beranda Utama
                </a>
            </div>
        </div>

        <script>
            // Universal password visibility toggle helper (guaranteed 100% vanilla JS execution)
            function togglePasswordVisibility(inputId, btn) {
                const input = document.getElementById(inputId);
                if (!input) return;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                const eyeOpen = btn.querySelector('.eye-open-icon');
                const eyeSlash = btn.querySelector('.eye-slash-icon');
                if (eyeOpen && eyeSlash) {
                    if (isPassword) {
                        eyeOpen.classList.add('hidden');
                        eyeSlash.classList.remove('hidden');
                        btn.setAttribute('title', 'Sembunyikan Kata Sandi');
                    } else {
                        eyeOpen.classList.remove('hidden');
                        eyeSlash.classList.add('hidden');
                        btn.setAttribute('title', 'Tampilkan Kata Sandi');
                    }
                }
            }
        </script>
    </body>
</html>
