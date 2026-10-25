<nav x-data="{ open: false }" class="bg-vinix-navy border-b border-blue-950 text-white shadow-md sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2.5 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-vinix-aurum to-amber-300 flex items-center justify-center font-black text-slate-950 shadow-md group-hover:scale-105 transition-transform">
                            7
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg tracking-wider text-white leading-tight">VINIX<span class="text-vinix-aurum">7</span></span>
                            <span class="text-[10px] text-blue-200 tracking-widest uppercase font-semibold">Kompas Karir SPK</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex">
                    @auth
                        @if(Auth::user()->isApplicant())
                            <a href="{{ route('applicant.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.dashboard') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Status Portal
                            </a>
                            <a href="{{ route('applicant.assessment') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.assessment') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Tes Kuesioner
                            </a>
                            <a href="{{ route('applicant.results') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.results') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 mr-1.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Rekomendasi SAW
                            </a>
                        @elseif(Auth::user()->isHrd())
                            <a href="{{ route('hrd.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('hrd.dashboard') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Dashboard Analitik
                            </a>
                            <a href="{{ route('hrd.applicants') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('hrd.applicants*') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Review Pelamar & Keputusan
                            </a>
                        @elseif(Auth::user()->isSuperAdmin())
                            <a href="{{ route('superadmin.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.dashboard') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                Overview
                            </a>
                            <a href="{{ route('superadmin.divisions') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.divisions*') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                14 Divisi
                            </a>
                            <a href="{{ route('superadmin.criteria') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.criteria*') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                Kriteria & 18 Soal
                            </a>
                            <a href="{{ route('superadmin.matrix-weights') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.matrix-weights*') ? 'bg-white/15 text-vinix-aurum border-b-2 border-vinix-aurum' : 'text-blue-100 hover:text-white hover:bg-white/10' }}">
                                <span class="w-2 h-2 rounded-full bg-vinix-aurum mr-1.5"></span>
                                Dynamic Matrix Bobot
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="flex items-center space-x-3">
                        <!-- Role Badge -->
                        <span class="px-2.5 py-1 text-[11px] font-extrabold uppercase rounded-full {{ Auth::user()->isSuperAdmin() ? 'bg-purple-900/60 text-purple-200 border border-purple-400' : (Auth::user()->isHrd() ? 'bg-amber-900/60 text-amber-200 border border-amber-400' : 'bg-blue-800 text-blue-200 border border-blue-400') }}">
                            {{ Auth::user()->role }}
                        </span>

                        <div x-data="{ userMenu: false }" class="relative">
                            <button @click="userMenu = !userMenu" class="flex items-center space-x-2 text-sm font-medium text-white hover:text-vinix-aurum focus:outline-none transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="userMenu"
                                @click.outside="userMenu = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-48 rounded-xl bg-white text-slate-800 shadow-xl py-2 z-50 border border-slate-100 font-medium">
                                
                                @if(Auth::user()->isApplicant())
                                    <a href="{{ route('applicant.profile') }}" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50">
                                        Edit Biodata Profil
                                    </a>
                                @endif

                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50">
                                    Akun & Keamanan
                                </a>

                                <div class="border-t border-slate-100 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-red-50 font-semibold">
                                        Keluar (Logout)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-vinix-aurum transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-xs font-bold px-4 py-2 bg-vinix-aurum text-slate-950 rounded-xl hover:bg-amber-400 transition shadow">Daftar Sekarang</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-blue-200 hover:text-white hover:bg-blue-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-blue-950/95 border-t border-blue-900 pb-3 pt-2">
        @auth
            <div class="px-4 py-2 border-b border-blue-900 mb-2">
                <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                <div class="text-xs text-blue-300">{{ Auth::user()->email }} ({{ strtoupper(Auth::user()->role) }})</div>
            </div>

            <div class="space-y-1 px-2">
                @if(Auth::user()->isApplicant())
                    <a href="{{ route('applicant.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Status Portal</a>
                    <a href="{{ route('applicant.assessment') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Tes Kuesioner</a>
                    <a href="{{ route('applicant.results') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Rekomendasi SAW</a>
                    <a href="{{ route('applicant.profile') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Edit Profil</a>
                @elseif(Auth::user()->isHrd())
                    <a href="{{ route('hrd.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Dashboard Analitik</a>
                    <a href="{{ route('hrd.applicants') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Review Pelamar & Keputusan</a>
                @elseif(Auth::user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Overview Super Admin</a>
                    <a href="{{ route('superadmin.divisions') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">14 Master Divisi</a>
                    <a href="{{ route('superadmin.criteria') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">7 Kriteria & 18 Soal</a>
                    <a href="{{ route('superadmin.matrix-weights') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-white hover:bg-blue-800">Dynamic Matrix Bobot</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-red-300 hover:bg-red-900/40">
                        Keluar (Logout)
                    </button>
                </form>
            </div>
        @else
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('login') }}" class="block text-center py-2 px-4 rounded-lg bg-blue-900 text-white font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="block text-center py-2 px-4 rounded-lg bg-vinix-aurum text-slate-900 font-bold">Daftar Akun Baru</a>
            </div>
        @endauth
    </div>
</nav>
