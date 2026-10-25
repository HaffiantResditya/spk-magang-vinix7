<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Tes Asesmen Kompetensi (Kompas Karir)
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Jawablah 18 pertanyaan berikut secara objektif untuk menghitung kecocokan pada 14 divisi magang.
                </p>
            </div>
            <a href="{{ route('applicant.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Status Portal
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <livewire:applicant.questionnaire-form />
    </div>
</x-app-layout>
