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

            <div class="flex items-center flex-wrap gap-2">
                <button type="button" onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-900 bg-amber-300 hover:bg-amber-400 border border-amber-400 shadow-xs transition"
                    title="Cetak atau Simpan seluruh halaman CV sebagai file PDF utuh">
                    <svg class="w-4 h-4 mr-1.5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak / Simpan PDF (Semua Halaman)
                </button>

                <a href="{{ $profile->raw_cv_url ?? $profile->cv_path }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 shadow-xs transition"
                    title="Buka file PDF asli langsung dari Cloudinary">
                    <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Buka PDF Asli
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
            <!-- Info Guide Banner -->
            <div class="bg-blue-50/80 border border-blue-200/90 rounded-2xl p-4 flex items-start space-x-3 text-xs text-blue-900 shadow-xs">
                <svg class="w-5 h-5 text-vinix-navy shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="space-y-1">
                    <p class="font-bold text-slate-800 text-sm">
                        Dokumen CV Pelamar (Lengkap Semua Halaman)
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Seluruh halaman berkas CV pelamar ditampilkan secara urut di bawah ini dalam kualitas tinggi. Anda dapat langsung memeriksa setiap halaman, membuka masing-masing halaman pada tab terpisah, atau mencetak/menyimpan seluruh dokumen menjadi 1 file PDF lengkap menggunakan tombol <strong>Cetak / Simpan PDF (Semua Halaman)</strong>.
                    </p>
                </div>
            </div>

            <!-- Cloudinary Multi-Page High-Resolution Document Render -->
            <div class="space-y-6">
                @foreach($profile->cv_pages as $index => $pageUrl)
                    <div id="page-{{ $index + 1 }}" class="cv-page-card bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/90 shadow-sm">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4 text-xs text-slate-500">
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-vinix-navy text-white font-bold text-xs">
                                    {{ $index + 1 }}
                                </span>
                                <span class="font-bold text-slate-800 text-sm">Halaman {{ $index + 1 }}</span>
                                <span class="text-[11px] text-slate-400 font-medium">(High-Resolution Render)</span>
                            </div>
                            <a href="{{ $pageUrl }}" target="_blank"
                                class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold text-vinix-navy bg-blue-50 border border-blue-200 hover:bg-blue-100 transition"
                                title="Buka gambar halaman {{ $index + 1 }} di tab baru">
                                Buka Halaman {{ $index + 1 }} di Tab Baru &nearr;
                            </a>
                        </div>
                        <div class="overflow-hidden rounded-xl bg-slate-50 flex justify-center p-2">
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
            header, nav, footer, button, a, .bg-blue-50\/80 {
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
