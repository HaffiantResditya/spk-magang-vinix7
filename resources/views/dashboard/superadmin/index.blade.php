<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Overview Super Admin
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pengelolaan Master Data SPK & Dynamic Weighting Matrix PT Vinix Seven Aurum.
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('superadmin.matrix-weights') }}" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-950 bg-vinix-aurum hover:bg-amber-400 transition shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-slate-950 mr-1.5"></span>
                    Kelola Bobot Matriks SAW
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Master Data Metric Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Master Divisi Magang</span>
                <span class="text-3xl font-black text-vinix-navy mt-1 block">{{ $divisionCount }}</span>
                <a href="{{ route('superadmin.divisions') }}" class="text-[11px] font-bold text-vinix-navy hover:underline mt-2 inline-block">
                    Kelola 19 Divisi &rarr;
                </a>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Kriteria Inti (C1-C7)</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $criteriaCount }}</span>
                <a href="{{ route('superadmin.criteria') }}" class="text-[11px] font-bold text-vinix-navy hover:underline mt-2 inline-block">
                    Lihat Kriteria &rarr;
                </a>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Pertanyaan Kuesioner</span>
                <span class="text-3xl font-black text-slate-900 mt-1 block">{{ $questionCount }}</span>
                <a href="{{ route('superadmin.criteria') }}" class="text-[11px] font-bold text-vinix-navy hover:underline mt-2 inline-block">
                    Kelola 18 Soal &rarr;
                </a>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-amber-200/80 shadow-xs bg-amber-50/20">
                <span class="text-xs font-bold text-amber-800 uppercase tracking-wider block">Bobot Matriks Divisi</span>
                <span class="text-3xl font-black text-amber-700 mt-1 block">{{ $matrixWeightsCount }}</span>
                <a href="{{ route('superadmin.matrix-weights') }}" class="text-[11px] font-bold text-amber-800 hover:underline mt-2 inline-block">
                    Edit Matrix SAW &rarr;
                </a>
            </div>
        </div>

        <!-- Quick Access Navigation -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-vinix-navy flex items-center justify-center font-bold mb-4">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">19 Divisi Magang</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Kelola nama dan deskripsi 19 alternatif divisi magang IT & Bisnis di PT Vinix Seven Aurum.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('superadmin.divisions') }}" class="inline-flex items-center text-xs font-bold text-vinix-navy hover:underline">
                        Buka Manajemen Divisi &rarr;
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold mb-4">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Kriteria & 18 Soal</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Pengelolaan 7 kriteria inti (Benefit) dan 18 instrumen kuesioner asesmen mandiri pelamar.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('superadmin.criteria') }}" class="inline-flex items-center text-xs font-bold text-vinix-navy hover:underline">
                        Buka Kriteria & Soal &rarr;
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border-2 border-vinix-aurum shadow-md flex flex-col justify-between bg-gradient-to-b from-amber-50/30 to-white">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-900 flex items-center justify-center font-bold mb-4">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Dynamic Matrix Weights</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Ubah persentase matriks bobot kriteria tiap divisi (19 x 7 = 133 titik bobot) secara dinamis tanpa sentuh kode.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-amber-200/50">
                    <a href="{{ route('superadmin.matrix-weights') }}" class="inline-flex items-center text-xs font-bold text-amber-800 hover:underline">
                        Kelola Matriks SAW &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
