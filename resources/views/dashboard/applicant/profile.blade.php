<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Edit Biodata & Profil Pelamar
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Lengkapi informasi profil dan instansi pendidikan/asal Anda.
                </p>
            </div>
            <a href="{{ route('applicant.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Status Portal
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto py-4">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
            <form method="POST" action="{{ route('applicant.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs">
                    @error('name')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled
                        class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 text-sm shadow-xs cursor-not-allowed">
                    <span class="text-[11px] text-slate-400 mt-1 block">Email akun tidak dapat diubah secara langsung.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Pelamar</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center p-3 rounded-xl border cursor-pointer {{ old('type', $user->profile?->type ?? 'mahasiswa') === 'mahasiswa' ? 'bg-blue-50 border-vinix-navy text-vinix-navy font-bold' : 'bg-white border-slate-200 text-slate-700' }}">
                            <input type="radio" name="type" value="mahasiswa" class="text-vinix-navy focus:ring-vinix-navy mr-2" {{ old('type', $user->profile?->type ?? 'mahasiswa') === 'mahasiswa' ? 'checked' : '' }}>
                            <span>Mahasiswa Aktif</span>
                        </label>
                        <label class="relative flex items-center p-3 rounded-xl border cursor-pointer {{ old('type', $user->profile?->type) === 'umum' ? 'bg-blue-50 border-vinix-navy text-vinix-navy font-bold' : 'bg-white border-slate-200 text-slate-700' }}">
                            <input type="radio" name="type" value="umum" class="text-vinix-navy focus:ring-vinix-navy mr-2" {{ old('type', $user->profile?->type) === 'umum' ? 'checked' : '' }}>
                            <span>Umum / Fresh Graduate</span>
                        </label>
                    </div>
                    @error('type')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="institution" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Asal Universitas / Instansi</label>
                    <input type="text" id="institution" name="institution" value="{{ old('institution', $user->profile?->institution) }}" required
                        placeholder="Contoh: Universitas Indonesia / Politeknik Negeri"
                        class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs">
                    @error('institution')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nomor WhatsApp Aktif</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->profile?->phone) }}" required
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs">
                    @error('phone')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-900 bg-vinix-aurum hover:bg-amber-400 active:scale-95 transition shadow-sm">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
