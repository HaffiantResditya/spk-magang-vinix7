<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/90 text-slate-800 shadow-xs sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo: Clean Standalone Official VINIX7 (Authentic Colored) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center group">
                        <x-application-logo variant="colored" class="h-8 w-auto object-contain group-hover:scale-105 transition-transform" />
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex">
                    @auth
                        @if(Auth::user()->isApplicant())
                            <a href="{{ route('applicant.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.dashboard') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Status Portal
                            </a>
                            <a href="{{ route('applicant.assessment') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.assessment') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Tes Kuesioner
                            </a>
                            <a href="{{ route('applicant.results') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('applicant.results') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 mr-1.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Rekomendasi SAW
                            </a>
                        @elseif(Auth::user()->isHrd())
                            <a href="{{ route('hrd.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('hrd.dashboard') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Dashboard Analitik
                            </a>
                            <a href="{{ route('hrd.applicants') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('hrd.applicants*') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Review Pelamar & Keputusan
                            </a>
                        @elseif(Auth::user()->isSuperAdmin())
                            <a href="{{ route('superadmin.dashboard') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.dashboard') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                Overview
                            </a>
                            <a href="{{ route('superadmin.divisions') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.divisions*') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                14 Divisi
                            </a>
                            <a href="{{ route('superadmin.criteria') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.criteria*') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
                                Kriteria & 18 Soal
                            </a>
                            <a href="{{ route('superadmin.matrix-weights') }}"
                                class="inline-flex items-center px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('superadmin.matrix-weights*') ? 'bg-blue-50 text-vinix-navy border-b-2 border-vinix-navy' : 'text-slate-600 hover:text-vinix-navy hover:bg-slate-50' }}">
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
                        <span class="px-2.5 py-1 text-[11px] font-extrabold uppercase rounded-full {{ Auth::user()->isSuperAdmin() ? 'bg-purple-100 text-purple-800 border border-purple-200' : (Auth::user()->isHrd() ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-blue-100 text-blue-800 border border-blue-200') }}">
                            {{ Auth::user()->role }}
                        </span>

                        <div x-data="{ userMenu: false }" class="relative">
                            <button @click="userMenu = !userMenu" class="flex items-center space-x-2 text-sm font-semibold text-slate-700 hover:text-vinix-navy px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 focus:outline-hidden transition cursor-pointer">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="userMenu"
                                @click.outside="userMenu = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-52 rounded-2xl bg-white text-slate-800 shadow-xl py-2 z-50 border border-slate-100 font-medium divide-y divide-slate-100">
                                
                                <div class="px-4 py-2">
                                    <p class="text-[11px] text-slate-400 uppercase tracking-wider font-semibold">Login sebagai</p>
                                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="py-1">
                                    @if(Auth::user()->isApplicant())
                                        <a href="{{ route('applicant.profile') }}" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50 transition">
                                            Edit Biodata Profil
                                        </a>
                                    @endif

                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-slate-700 hover:bg-slate-50 transition">
                                        Akun & Keamanan
                                    </a>
                                </div>

                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form-desktop">
                                        @csrf
                                        <button type="button" onclick="confirmLogout(event, 'logout-form-desktop')" class="w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-red-50 font-semibold cursor-pointer flex items-center transition">
                                            <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar (Logout)
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-vinix-navy transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-xs font-bold px-4 py-2 bg-gradient-to-r from-vinix-aurum to-amber-400 text-slate-950 rounded-xl hover:from-amber-400 hover:to-amber-500 transition shadow-xs">Daftar Sekarang</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-hidden transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white border-t border-slate-100 pb-3 pt-2 shadow-lg">
        @auth
            <div class="px-4 py-2.5 border-b border-slate-100 mb-2">
                <div class="font-bold text-base text-slate-900">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500">{{ Auth::user()->email }} ({{ strtoupper(Auth::user()->role) }})</div>
            </div>

            <div class="space-y-1 px-2">
                @if(Auth::user()->isApplicant())
                    <a href="{{ route('applicant.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Status Portal</a>
                    <a href="{{ route('applicant.assessment') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Tes Kuesioner</a>
                    <a href="{{ route('applicant.results') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Rekomendasi SAW</a>
                    <a href="{{ route('applicant.profile') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Edit Profil</a>
                @elseif(Auth::user()->isHrd())
                    <a href="{{ route('hrd.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Dashboard Analitik</a>
                    <a href="{{ route('hrd.applicants') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Review Pelamar & Keputusan</a>
                @elseif(Auth::user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Overview Super Admin</a>
                    <a href="{{ route('superadmin.divisions') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">14 Master Divisi</a>
                    <a href="{{ route('superadmin.criteria') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">7 Kriteria & 18 Soal</a>
                    <a href="{{ route('superadmin.matrix-weights') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-vinix-navy">Dynamic Matrix Bobot</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile" class="pt-2 border-t border-slate-100 mt-2">
                    @csrf
                    <button type="button" onclick="confirmLogout(event, 'logout-form-mobile')" class="w-full text-left px-3 py-2 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 cursor-pointer flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar (Logout)
                    </button>
                </form>
            </div>
        @else
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('login') }}" class="block text-center py-2 px-4 rounded-lg bg-slate-100 text-slate-800 font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="block text-center py-2 px-4 rounded-lg bg-gradient-to-r from-vinix-aurum to-amber-400 text-slate-950 font-bold">Daftar Akun Baru</a>
            </div>
        @endauth
    </div>
</nav>


<script>
    function confirmLogout(event, formId) {
        if (event) event.preventDefault();
        const form = document.getElementById(formId);
        if (!form) return;

        if (window.Swal) {
            window.Swal.fire({
                title: 'Konfirmasi Keluar',
                text: 'Apakah Anda yakin ingin mengakhiri sesi dan keluar dari sistem?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
                    title: 'text-lg font-bold text-slate-900',
                    htmlContainer: 'text-sm text-slate-600',
                    confirmButton: 'px-5 py-2.5 rounded-xl font-bold text-sm text-white shadow-md bg-red-600 hover:bg-red-700',
                    cancelButton: 'px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 bg-slate-100 hover:bg-slate-200 shadow-xs'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                form.submit();
            }
        }
    }
</script>
