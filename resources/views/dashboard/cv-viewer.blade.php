<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-100 text-vinix-navy border border-blue-200">
                        Dokumen CV Pelamar
                    </span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs text-slate-500 font-medium">Format: PDF</span>
                </div>
                <h2 class="font-extrabold text-2xl text-slate-900 mt-1 leading-tight">
                    {{ $applicant->name }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    {{ $applicant->email }} &bull; {{ $applicant->profile?->institution ?? '-' }} ({{ ucfirst($applicant->profile?->type ?? 'Mahasiswa') }})
                </p>
            </div>

            <div class="flex items-center space-x-2.5">
                <button type="button" onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 shadow-xs transition">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak / Simpan
                </button>

                <a href="{{ $profile->cv_url }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 shadow-xs transition"
                    title="Buka URL asli file">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    File Asli
                </a>

                <a href="{{ $backUrl }}"
                    class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 shadow-sm transition">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 space-y-6">
        @if(str_contains($profile->cv_path, 'res.cloudinary.com'))
            <!-- Cloudinary Multi-Page High-Resolution Document Render -->
            <div class="space-y-6">
                @foreach($profile->cv_pages as $index => $pageUrl)
                    <div class="cv-page-card bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/90 shadow-sm">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4 text-xs text-slate-500">
                            <span class="font-bold text-slate-700">Halaman {{ $index + 1 }}</span>
                            <span class="text-[11px] text-slate-400">High-Resolution Render</span>
                        </div>
                        <div class="overflow-hidden rounded-xl bg-slate-50 flex justify-center">
                            <img src="{{ $pageUrl }}"
                                alt="CV {{ $applicant->name }} - Halaman {{ $index + 1 }}"
                                loading="lazy"
                                onerror="this.closest('.cv-page-card').style.display='none';"
                                class="w-full max-w-3xl h-auto rounded-lg shadow-sm border border-slate-200/60 object-contain">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Local PDF Preview Frame -->
            <div class="bg-white rounded-3xl p-4 border border-slate-200 shadow-sm">
                <iframe src="{{ $profile->cv_url }}" class="w-full h-[85vh] rounded-2xl border border-slate-100"></iframe>
            </div>
        @endif
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            header, nav, footer, button, a {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .cv-page-card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                page-break-after: always;
            }
        }
    </style>
</x-app-layout>

