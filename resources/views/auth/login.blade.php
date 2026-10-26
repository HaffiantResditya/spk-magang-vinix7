<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-900">Masuk ke Portal</h2>
        <p class="text-xs text-slate-500 mt-1">Gunakan akun terdaftar Anda untuk mengakses SPK Kompas Karir</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
            <input id="email" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <div class="relative">
                <input id="password"
                    class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs pr-10"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    required autocomplete="current-password" />
                <button type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-700 focus:outline-hidden transition"
                    tabindex="-1"
                    title="Tampilkan / Sembunyikan Kata Sandi">
                    <!-- Eye Open (when hidden) -->
                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <!-- Eye Slash (when shown) -->
                    <svg x-show="showPassword" x-cloak class="w-4 h-4 text-vinix-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-vinix-navy shadow-xs focus:ring-vinix-navy" name="remember">
                <span class="ms-2 text-xs text-slate-600 font-medium">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-vinix-navy hover:underline font-semibold" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full py-3 px-4 rounded-xl text-sm font-bold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 shadow-lg shadow-amber-500/20 active:scale-95 transition">
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

    <!-- Quick Role Credentials Helper -->
    <div class="mt-6 p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-[11px] text-slate-600 space-y-1.5">
        <span class="font-bold text-slate-800 block text-xs flex items-center">
            <svg class="w-3.5 h-3.5 mr-1.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            Kredensial Default (Testing / Seeder):
        </span>
        <div class="flex justify-between">
            <span>Super Admin:</span>
            <code class="font-mono text-slate-800 font-semibold">superadmin.vinix7@gmail.com | password</code>
        </div>
        <div class="flex justify-between">
            <span>Admin HRD:</span>
            <code class="font-mono text-slate-800 font-semibold">hrd.vinix7@gmail.com | password</code>
        </div>
        <div class="flex justify-between">
            <span>Pelamar Test:</span>
            <code class="font-mono text-slate-800 font-semibold">pelamar.vinix7@gmail.com | password</code>
        </div>
    </div>
</x-guest-layout>
