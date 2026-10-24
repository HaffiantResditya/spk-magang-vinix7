<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-900">Registrasi Pelamar Baru</h2>
        <p class="text-xs text-slate-500 mt-1">Buat akun untuk memulai asesmen Kompas Karir PT Vinix Seven Aurum</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
            <input id="name" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
            <input id="email" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Applicant Type -->
        <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kategori Pelamar</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex items-center p-2.5 rounded-xl border border-slate-200 cursor-pointer text-xs font-semibold text-slate-700 hover:bg-slate-50">
                    <input type="radio" name="type" value="mahasiswa" checked class="text-vinix-navy focus:ring-vinix-navy mr-2">
                    Mahasiswa Aktif
                </label>
                <label class="flex items-center p-2.5 rounded-xl border border-slate-200 cursor-pointer text-xs font-semibold text-slate-700 hover:bg-slate-50">
                    <input type="radio" name="type" value="umum" class="text-vinix-navy focus:ring-vinix-navy mr-2">
                    Umum / Fresh Grad
                </label>
            </div>
            <x-input-error :messages="$errors->get('type')" class="mt-1" />
        </div>

        <!-- Institution -->
        <div>
            <label for="institution" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Asal Universitas / Instansi</label>
            <input id="institution" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="text" name="institution" value="{{ old('institution') }}" placeholder="Contoh: Universitas Indonesia" required />
            <x-input-error :messages="$errors->get('institution')" class="mt-1" />
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor WhatsApp Aktif</label>
            <input id="phone" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs" type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <input id="password" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 rounded-xl text-sm font-bold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 shadow-lg shadow-amber-500/20 active:scale-95 transition">
                Daftar Akun Pelamar
            </button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 text-center text-xs text-slate-600">
        Sudah memiliki akun?
        <a href="{{ route('login') }}" class="font-bold text-vinix-navy hover:underline">
            Masuk di sini
        </a>
    </div>
</x-guest-layout>
