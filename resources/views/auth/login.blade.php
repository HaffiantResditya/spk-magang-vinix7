<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-900">Masuk ke Portal</h2>
        <p class="text-xs text-slate-500 mt-1">Gunakan akun terdaftar Anda untuk mengakses SPK Kompas Karir</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Swal) {
                    window.Swal.fire({
                        icon: 'error',
                        title: 'Autentikasi Gagal',
                        text: @json($errors->first()),
                        confirmButtonColor: '#0F172A',
                        confirmButtonText: 'Periksa Kembali',
                        customClass: {
                            popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
                            title: 'text-lg font-bold text-slate-900',
                            htmlContainer: 'text-sm text-slate-600',
                            confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm bg-slate-900 text-white shadow-md'
                        }
                    });
                }
            });
        </script>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
            <input id="email" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password with Eye Toggle -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <div class="relative">
                <input id="password"
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs pr-11 font-sans"
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                    placeholder="••••••••" />
                <button type="button"
                    id="toggle-password-btn"
                    onclick="togglePasswordVisibility('password', this)"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-vinix-navy focus:outline-hidden transition cursor-pointer"
                    tabindex="-1"
                    title="Tampilkan / Sembunyikan Kata Sandi">
                    <!-- Eye Open (when hidden) -->
                    <svg class="eye-open-icon w-5 h-5 transition-transform hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Eye Slash (when shown) -->
                    <svg class="eye-slash-icon w-5 h-5 text-amber-600 hidden transition-transform hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-vinix-navy shadow-xs focus:ring-vinix-navy cursor-pointer" name="remember">
                <span class="ms-2 text-xs text-slate-600 font-medium">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-vinix-navy hover:underline font-semibold" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full py-3 px-4 rounded-xl text-sm font-bold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 shadow-lg shadow-amber-500/20 active:scale-95 transition cursor-pointer">
                Masuk ke Akun
            </button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-600">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="font-bold text-vinix-navy hover:underline">
            Daftar sebagai Pelamar
        </a>
    </div>
</x-guest-layout>
