<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Rekomendasi Penempatan Divisi
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Hasil kalkulasi matriks algoritma Simple Additive Weighting (SAW) untuk profil Anda.
                </p>
            </div>
            <a href="{{ route('applicant.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Status Portal
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <livewire:applicant.saw-result-board />
    </div>
</x-app-layout>
