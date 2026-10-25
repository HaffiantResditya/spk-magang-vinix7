<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Portal Pelamar Magang
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Selamat datang kembali, <span class="font-semibold text-slate-800">{{ $user->name }}</span>
                </p>
            </div>
            <div>
                @if(!$application)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-300">
                        Belum Mengajukan Lamaran
                    </span>
                @elseif($application->status === 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                        <span class="w-2 h-2 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                        Menunggu Review HRD
                    </span>
                @elseif($application->status === 'approved')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1.5"></span>
                        Lamaran Diterima
                    </span>
                @elseif($application->status === 'reassigned')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-300">
                        <span class="w-2 h-2 rounded-full bg-blue-500 mr-1.5"></span>
                        Dialihkan Divisi Lain
                    </span>
                @elseif($application->status === 'rejected')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-300">
                        Belum Lolos Seleksi
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Status Notification Box -->
        @if(!$application)
            <div class="bg-gradient-to-r from-vinix-navy to-blue-900 rounded-3xl p-6 sm:p-8 text-white shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2 max-w-xl">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-vinix-aurum/20 text-vinix-aurum border border-vinix-aurum/40">
                        Langkah Penting
                    </span>
                    <h3 class="text-2xl font-bold">Lengkapi Asesmen Kompas Karir Anda</h3>
                    <p class="text-sm text-blue-100/90 leading-relaxed">
                        Anda belum mengirimkan pengajuan divisi magang. Silakan isi 18 pertanyaan asesmen kompetensi untuk menemukan 3 divisi yang paling cocok dengan keahlian Anda.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('applicant.assessment') }}" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-extrabold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 shadow-lg shadow-amber-500/25 transition">
                        {{ $hasCompletedAssessment ? 'Lihat Rekomendasi & Pilih Divisi' : 'Mulai Isi Kuesioner' }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @elseif($application->status === 'pending')
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200/80 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-amber-100 text-amber-900">
                        Dalam Proses Seleksi
                    </span>
                    <h3 class="text-xl font-bold text-slate-900">Lamaran Anda Sedang Ditinjau Tim HRD</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Pengajuan untuk divisi <span class="font-bold text-vinix-navy">{{ $application->selectedDivision->name }}</span> telah diterima sistem. Tim HRD PT Vinix Seven Aurum sedang mengevaluasi skor asesmen SAW dan CV Anda.
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('applicant.results') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        Cek Skor SAW
                    </a>
                </div>
            </div>
        @elseif($application->status === 'approved')
            <div class="bg-gradient-to-r from-emerald-800 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 text-white border border-white/30">
                        Selamat!
                    </span>
                    <h3 class="text-2xl font-bold">Lamaran Anda Diterima di {{ $application->approvedDivision->name }}</h3>
                    <p class="text-sm text-emerald-100 leading-relaxed">
                        Berdasarkan hasil asesmen SAW dan kualifikasi berkas, Anda dinyatakan lolos seleksi penempatan magang di PT Vinix Seven Aurum.
                    </p>
                    @if($application->hrd_notes)
                        <div class="mt-3 p-3 bg-white/10 rounded-xl text-xs text-emerald-50 border border-white/20">
                            <strong>Catatan HRD:</strong> {{ $application->hrd_notes }}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($application->status === 'reassigned')
            <div class="bg-gradient-to-r from-blue-900 to-indigo-950 rounded-3xl p-6 sm:p-8 text-white shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-vinix-aurum/30 text-vinix-aurum border border-vinix-aurum/40">
                        Keputusan Penempatan Alternatif
                    </span>
                    <h3 class="text-2xl font-bold">Diterima di Divisi: {{ $application->approvedDivision->name }}</h3>
                    <p class="text-sm text-blue-100 leading-relaxed">
                        Awalnya Anda mengajukan <span class="font-semibold">{{ $application->selectedDivision->name }}</span>. Atas pertimbangan kuota dan kecocokan algoritma SAW, HRD mengalihkan penempatan Anda ke divisi alternatif di atas.
                    </p>
                    @if($application->hrd_notes)
                        <div class="mt-3 p-3 bg-white/10 rounded-xl text-xs text-blue-50 border border-white/20">
                            <strong>Alasan / Catatan HRD:</strong> {{ $application->hrd_notes }}
                        </div>
                    @endif
                </div>
            </div>
        @elseif($application->status === 'rejected')
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-red-200 shadow-xs">
                <div class="space-y-2">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-red-100 text-red-800">
                        Hasil Seleksi
                    </span>
                    <h3 class="text-xl font-bold text-slate-900">Belum Lolos Seleksi Periode Ini</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Terima kasih atas partisipasi Anda dalam program magang PT Vinix Seven Aurum. Saat ini kuota untuk penempatan yang Anda tuju telah terpenuhi. Tetap semangat mengasah kompetensi Anda!
                    </p>
                    @if($application->hrd_notes)
                        <div class="mt-3 p-3 bg-red-50 rounded-xl text-xs text-red-700 border border-red-200">
                            <strong>Catatan HRD:</strong> {{ $application->hrd_notes }}
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Profile & Recommendations Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Biodata Profile Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <h3 class="text-lg font-bold text-slate-900">Profil Pelamar</h3>
                    <a href="{{ route('applicant.profile') }}" class="text-xs font-semibold text-vinix-navy hover:underline">
                        Edit
                    </a>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block font-medium">Nama Lengkap</span>
                        <span class="font-bold text-slate-800">{{ $user->name }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block font-medium">Alamat Email</span>
                        <span class="font-medium text-slate-700">{{ $user->email }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block font-medium">Status Pelamar</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold capitalize {{ $user->profile?->type === 'mahasiswa' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ $user->profile?->type ?? 'Mahasiswa' }}
                        </span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block font-medium">Asal Universitas / Instansi</span>
                        <span class="font-medium text-slate-700">{{ $user->profile?->institution ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block font-medium">No. WhatsApp</span>
                        <span class="font-medium text-slate-700">{{ $user->profile?->phone ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block font-medium">Dokumen CV</span>
                        @if($user->profile?->cv_path)
                            <a href="{{ asset('storage/' . $user->profile->cv_path) }}" target="_blank" class="inline-flex items-center text-xs font-bold text-vinix-navy hover:underline mt-1">
                                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                Lihat File CV (PDF)
                            </a>
                        @else
                            <span class="text-xs text-slate-400 italic">Belum diunggah</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Top 3 Recommendations Overview -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Rekomendasi Algoritma SAW</h3>
                        <p class="text-xs text-slate-400">Peringkat kecocokan teratas dari 14 divisi magang</p>
                    </div>
                    @if($hasCompletedAssessment)
                        <a href="{{ route('applicant.results') }}" class="text-xs font-bold text-vinix-navy hover:underline">
                            Lihat Rincian &rarr;
                        </a>
                    @endif
                </div>

                @if($topRecommendations->count() > 0)
                    <div class="space-y-4">
                        @foreach($topRecommendations as $rec)
                            <div class="p-5 rounded-2xl border transition-all {{ $rec->rank === 1 ? 'bg-amber-50/50 border-amber-300 ring-2 ring-amber-400/20' : 'bg-slate-50/50 border-slate-200' }}">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span class="w-8 h-8 rounded-xl flex items-center justify-center text-xs font-extrabold {{ $rec->rank === 1 ? 'bg-vinix-aurum text-slate-950 shadow-sm' : 'bg-slate-200 text-slate-700' }}">
                                            #{{ $rec->rank }}
                                        </span>
                                        <div>
                                            <h4 class="font-bold text-slate-900 text-base">{{ $rec->division->name }}</h4>
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $rec->division->description }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-lg font-black text-vinix-navy">{{ number_format($rec->final_score, 1) }}%</span>
                                        <span class="text-[10px] text-slate-400 block">Kecocokan</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 space-y-4">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-vinix-navy flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base">Hasil Rekomendasi Belum Tersedia</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Anda belum menyelesaikan 18 instrumen penilaian diri. Silakan lakukan tes sekarang untuk mengetahui divisi magang yang paling sesuai.
                        </p>
                        <a href="{{ route('applicant.assessment') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition">
                            Mulai Kuesioner Kompas Karir
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
