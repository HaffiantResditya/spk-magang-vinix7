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

                <div x-data="{ applicantType: '{{ old('type', $user->profile?->type ?? 'mahasiswa') }}' }">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Pelamar</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label :class="applicantType === 'mahasiswa' ? 'bg-blue-50 border-vinix-navy text-vinix-navy font-bold ring-2 ring-vinix-navy/20' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50'" class="relative flex items-center p-3 rounded-xl border cursor-pointer transition-all">
                            <input type="radio" name="type" value="mahasiswa" x-model="applicantType" class="text-vinix-navy focus:ring-vinix-navy mr-2">
                            <span>Mahasiswa Aktif</span>
                        </label>
                        <label :class="applicantType === 'umum' ? 'bg-blue-50 border-vinix-navy text-vinix-navy font-bold ring-2 ring-vinix-navy/20' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50'" class="relative flex items-center p-3 rounded-xl border cursor-pointer transition-all">
                            <input type="radio" name="type" value="umum" x-model="applicantType" class="text-vinix-navy focus:ring-vinix-navy mr-2">
                            <span>Umum / Fresh Graduate</span>
                        </label>
                    </div>
                    @error('type')
                        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                    @enderror

                    <div class="mt-5">
                        <label for="institution" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            <span x-show="applicantType === 'mahasiswa'">Asal Universitas / Perguruan Tinggi</span>
                            <span x-show="applicantType === 'umum'" x-cloak>Asal Instansi / Universitas Almamater / Portofolio</span>
                        </label>
                        <input type="text" id="institution" name="institution" value="{{ old('institution', $user->profile?->institution) }}" required
                            :placeholder="applicantType === 'mahasiswa' ? 'Contoh: Universitas Indonesia / ITB / Politeknik Negeri' : 'Contoh: Alumni Universitas Brawijaya / PT Telkom / Freelance Web Dev'"
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy shadow-xs">
                        <p class="text-[11px] text-slate-500 mt-1.5 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-vinix-navy flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <span x-show="applicantType === 'mahasiswa'">Bagi mahasiswa aktif, isi nama kampus tempat Anda berkuliah saat ini.</span>
                            <span x-show="applicantType === 'umum'" x-cloak>Bagi pelamar umum/fresh grad, Anda dapat menulis nama kampus almamater kelulusan, nama perusahaan/instansi terakhir, atau "Freelance / Independen".</span>
                        </p>
                        @error('institution')
                            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
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
