<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-vinix-bg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kompas Karir SPK Penempatan Divisi Magang | PT Vinix Seven Aurum</title>

        <!-- Google Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-vinix-bg min-h-full flex flex-col selection:bg-vinix-aurum selection:text-slate-900">
        <!-- Enterprise Header -->
        <header class="bg-vinix-navy border-b border-blue-950 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-vinix-aurum to-amber-300 flex items-center justify-center font-black text-slate-950 text-xl shadow-lg">
                        7
                    </div>
                    <div>
                        <span class="text-xl sm:text-2xl font-black tracking-wider text-white">VINIX<span class="text-vinix-aurum">7</span></span>
                        <span class="text-[10px] text-blue-200 block uppercase tracking-widest font-semibold">PT Vinix Seven Aurum</span>
                    </div>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 text-xs sm:text-sm font-bold text-slate-950 bg-vinix-aurum hover:bg-amber-400 rounded-xl shadow-sm transition">
                            Masuk ke Dashboard
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs sm:text-sm font-semibold text-blue-100 hover:text-white px-3 py-2 rounded-lg hover:bg-white/10 transition">
                            Masuk Portal
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-xs sm:text-sm font-bold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 rounded-xl shadow-md transition">
                            Daftar Pelamar
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-b from-vinix-navy via-blue-900 to-indigo-950 text-white py-20 sm:py-28 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto text-center relative z-10 space-y-6">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-vinix-aurum/20 text-vinix-aurum border border-vinix-aurum/40 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-vinix-aurum mr-2 animate-ping"></span>
                    Magang & Studi Independen BATCH 5 &bull; Learn. Build. Impact.
                </div>

                <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-tight">
                    Kompas Karir Talenta Magang<br>
                    <span class="bg-gradient-to-r from-vinix-aurum via-amber-300 to-yellow-200 bg-clip-text text-transparent">PT Vinix Seven Aurum</span>
                </h1>

                <p class="max-w-3xl mx-auto text-base sm:text-xl text-blue-100/90 font-normal leading-relaxed">
                    Petakan kompetensi riil Anda secara terukur ke dalam <span class="text-vinix-aurum font-bold">14 Divisi Spesifik</span> IT & Bisnis menggunakan mesin matematis <em>Simple Additive Weighting</em> (SAW) sebelum mengirimkan lamaran resmi.
                </p>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('applicant.assessment') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-extrabold text-slate-950 bg-gradient-to-r from-vinix-aurum via-yellow-400 to-amber-500 hover:from-yellow-400 hover:to-amber-600 shadow-xl shadow-amber-500/25 transition active:scale-95">
                            Mulai Tes Kuesioner Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-extrabold text-slate-950 bg-gradient-to-r from-vinix-aurum via-yellow-400 to-amber-500 hover:from-yellow-400 hover:to-amber-500 shadow-xl shadow-amber-500/25 transition active:scale-95">
                            Registrasi & Mulai Asesmen
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl text-base font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 transition">
                            Login Portal Pelamar / HRD
                        </a>
                    @endauth
                </div>

                <!-- Stats Bar -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-12 text-left max-w-4xl mx-auto">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                        <span class="text-3xl font-extrabold text-vinix-aurum">14</span>
                        <p class="text-xs text-blue-200 mt-1">Pilihan Open Roles Batch 5</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                        <span class="text-3xl font-extrabold text-vinix-aurum">7</span>
                        <p class="text-xs text-blue-200 mt-1">Kriteria Inti (C1 - C7)</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                        <span class="text-3xl font-extrabold text-vinix-aurum">18</span>
                        <p class="text-xs text-blue-200 mt-1">Instrumen Soal Multi-step</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                        <span class="text-3xl font-extrabold text-vinix-aurum">Top 3</span>
                        <p class="text-xs text-blue-200 mt-1">Rekomendasi Berbasis Data</p>
                    </div>
                </div>
            </div>

            <!-- Background Glow -->
            <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full bg-blue-600/20 blur-3xl pointer-events-none"></div>
            <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-vinix-aurum/15 blur-3xl pointer-events-none"></div>
        </section>

        <!-- 14 Open Roles Showcase (Matching Poster) -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="text-center space-y-3 mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-vinix-navy bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Program Magang & Studi Independen Batch 5
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900">14 Pilihan Divisi (Open Roles)</h2>
                <p class="text-sm text-slate-500 max-w-2xl mx-auto">
                    Kesempatan untuk mengembangkan skill, mengerjakan project nyata, dan berdampak bersama VINIX7.
                </p>
            </div>

            @php
                $roles = [
                    ['name' => 'Human Resource (SDM) Analyst', 'badge' => 'SDM & People', 'color' => 'amber'],
                    ['name' => 'Digital Public Relations & Communication Specialist', 'badge' => 'Public Relations', 'color' => 'blue'],
                    ['name' => 'Python Data Science Engineer', 'badge' => 'Data Science', 'color' => 'indigo'],
                    ['name' => 'Ethical Hacker', 'badge' => 'Security', 'color' => 'rose'],
                    ['name' => 'Data Analyst', 'badge' => 'Data & BI', 'color' => 'sky'],
                    ['name' => 'Bisnis Digital Analyst', 'badge' => 'Business', 'color' => 'emerald'],
                    ['name' => 'Python Machine Learning & AI Engineer', 'badge' => 'AI & ML', 'color' => 'purple'],
                    ['name' => 'Cybersecurity Engineer', 'badge' => 'Cyber Infra', 'color' => 'cyan'],
                    ['name' => 'Web & UIUX Developer', 'badge' => 'Web & UI/UX', 'color' => 'blue'],
                    ['name' => 'Investment & Financial Market Analyst', 'badge' => 'Finance', 'color' => 'amber'],
                    ['name' => 'Social Media & Digital Marketing Strategist', 'badge' => 'Marketing', 'color' => 'pink'],
                    ['name' => 'Business Administration Intelligence Analyst (Power BI & Excel)', 'badge' => 'Power BI & Excel', 'color' => 'emerald'],
                    ['name' => 'Tech Project Management Specialist', 'badge' => 'Agile PM', 'color' => 'indigo'],
                    ['name' => 'Cybercrime & Forensic Investigator', 'badge' => 'Digital Forensics', 'color' => 'slate'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($roles as $idx => $r)
                    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs hover:border-vinix-navy/40 hover:shadow-md transition flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-3.5">
                            <span class="w-8 h-8 rounded-xl bg-vinix-navy text-white text-xs font-black flex items-center justify-center flex-shrink-0">
                                {{ $idx + 1 }}
                            </span>
                            <div>
                                <h3 class="font-bold text-slate-900 text-sm sm:text-base leading-snug">{{ $r['name'] }}</h3>
                                <span class="text-[11px] text-slate-400">Open Role Batch 5</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 flex-shrink-0">
                            {{ $r['badge'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 3-Step Journey -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto border-t border-slate-200/60">
            <div class="text-center space-y-3 mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-vinix-navy">Alur Pendaftaran Terpadu</span>
                <h2 class="text-3xl font-bold text-slate-900">3 Langkah Mudah Menemukan Divisi Idaman</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-xs relative">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-vinix-navy font-black text-xl flex items-center justify-center mb-6 border border-blue-100">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Registrasi & Asesmen</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Buat akun pelamar dan jawab 18 pertanyaan interaktif dengan skala 20-100 secara jujur dan objektif.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 border-2 border-vinix-aurum shadow-md relative">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 font-black text-xl flex items-center justify-center mb-6 border border-amber-200">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Kalkulasi SAW Instan</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Sistem mengalikan nilai normalisasi Anda dengan 98 bobot matriks divisi, menampilkan Top 3 Rekomendasi terbaik.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-xs relative">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 font-black text-xl flex items-center justify-center mb-6 border border-emerald-100">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Pilih & Unggah CV</h3>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Pilih divisi dari rekomendasi SAW, unggah CV PDF, dan kirimkan ke HRD untuk ditinjau secara langsung.
                    </p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-10 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-vinix-navy flex items-center justify-center text-vinix-aurum font-black">7</div>
                    <div>
                        <span class="font-bold text-slate-800 text-sm">PT Vinix Seven Aurum</span>
                        <p class="text-slate-400">Kompas Karir SPK Penempatan Divisi Magang</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6 text-slate-600 font-medium">
                    <a href="https://vinix7.id" target="_blank" class="hover:text-vinix-navy transition">Website Resmi vinix7.id</a>
                    <a href="{{ route('login') }}" class="hover:text-vinix-navy transition">Portal Login</a>
                    <a href="{{ route('register') }}" class="hover:text-vinix-navy transition">Registrasi Pelamar</a>
                </div>
            </div>
        </footer>
    </body>
</html>
