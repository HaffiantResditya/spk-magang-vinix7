<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-vinix-navy via-blue-900 to-indigo-950 text-white p-8 sm:p-10 shadow-xl border border-blue-800">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-semibold bg-vinix-aurum/20 text-vinix-aurum border border-vinix-aurum/40 mb-3">
                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Hasil Algoritma Simple Additive Weighting (SAW)
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Kompas Karir Anda Telah Dihitung</h1>
            <p class="mt-3 text-slate-300 text-sm sm:text-base leading-relaxed">
                Berdasarkan 18 indikator kompetensi yang Anda isi, mesin analitik kami telah memetakan bobot preferensi Anda ke seluruh 14 divisi magang PT Vinix Seven Aurum. Berikut <span class="text-vinix-aurum font-bold">Top 3 Rekomendasi Divisi</span> yang paling sesuai dengan profil keahlian Anda.
            </p>
        </div>
        <!-- Decorative Glow -->
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-vinix-aurum/15 blur-3xl pointer-events-none"></div>
    </div>

    <!-- Top 3 Recommendation Cards -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-900 flex items-center">
                <span class="w-3 h-3 rounded-full bg-vinix-aurum mr-2.5 animate-pulse"></span>
                Top 3 Rekomendasi Divisi Magang
            </h2>
            <span class="text-xs text-slate-500">Klik salah satu kartu untuk memilih divisi lamaran final</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($top3 as $res)
                @php
                    $isChosen = ($selectedDivisionId === $res->division_id);
                    $badgeColors = [
                        1 => ['bg' => 'bg-amber-500', 'text' => 'text-amber-950', 'border' => 'border-amber-400', 'title' => 'Rekomendasi Utama #1'],
                        2 => ['bg' => 'bg-slate-300', 'text' => 'text-slate-800', 'border' => 'border-slate-300', 'title' => 'Rekomendasi Alternatif #2'],
                        3 => ['bg' => 'bg-amber-700', 'text' => 'text-amber-100', 'border' => 'border-amber-600', 'title' => 'Rekomendasi Alternatif #3'],
                    ];
                    $badge = $badgeColors[$res->rank] ?? $badgeColors[1];
                @endphp

                <div wire:click="selectDivision({{ $res->division_id }})"
                    class="relative rounded-2xl p-6 cursor-pointer transition-all duration-300 flex flex-col justify-between {{ $isChosen ? 'bg-gradient-to-b from-amber-50/70 to-white border-2 border-vinix-aurum shadow-lg ring-4 ring-vinix-aurum/20 scale-[1.02]' : 'bg-white border border-slate-200/90 hover:border-vinix-aurum/60 hover:shadow-md' }}">
                    
                    @if($isChosen)
                        <div class="absolute -top-3.5 right-6 px-3 py-1 bg-vinix-navy text-white text-[11px] font-bold rounded-full shadow-sm flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>PILIHAN ANDA</span>
                        </div>
                    @endif

                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-extrabold {{ $badge['bg'] }} {{ $badge['text'] }}">
                                Rank #{{ $res->rank }}
                            </span>
                            <div class="text-right">
                                <span class="text-2xl font-black text-vinix-navy">{{ number_format($res->final_score, 1) }}%</span>
                                <span class="text-[10px] text-slate-400 block font-medium">Skor Kecocokan</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-vinix-navy transition-colors">
                            {{ $res->division->name }}
                        </h3>

                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                            {{ $res->division->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-semibold {{ $isChosen ? 'text-amber-700' : 'text-slate-400' }}">
                            {{ $isChosen ? 'Divisi Terpilih' : 'Pilih Divisi Ini' }}
                        </span>
                        <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center {{ $isChosen ? 'border-vinix-aurum bg-vinix-aurum text-slate-900' : 'border-slate-300' }}">
                            @if($isChosen)
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Finalization & CV Upload Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-6">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-xl font-bold text-slate-900">Finalisasi Pengajuan Lamaran Magang</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Langkah terakhir: Unggah Curriculum Vitae (CV) terbaru Anda dalam format PDF dan konfirmasi pendaftaran.
            </p>
        </div>

        @if(session()->has('error'))
            <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="submitFinalApplication" class="space-y-6">
            <!-- Selected Division Confirmation -->
            <div class="bg-blue-50/60 border border-blue-200/70 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <span class="text-xs font-semibold text-blue-700 uppercase tracking-wider block">Divisi yang Diajukan</span>
                    @php
                        $chosenDivision = $allResults->firstWhere('division_id', $selectedDivisionId)?->division;
                    @endphp
                    <span class="text-base sm:text-lg font-bold text-slate-900 mt-0.5 block">
                        {{ $chosenDivision ? $chosenDivision->name : 'Silakan pilih salah satu dari 3 divisi di atas' }}
                    </span>
                </div>
                <div class="flex items-center text-xs text-blue-800 bg-white/80 px-3 py-1.5 rounded-lg border border-blue-200">
                    <svg class="w-4 h-4 mr-1.5 text-vinix-navy" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Sesuai Rekomendasi SAW
                </div>
            </div>

            <!-- CV Upload Input -->
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-800">
                    Dokumen Curriculum Vitae (CV) <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-slate-300 hover:border-vinix-navy/60 rounded-2xl p-6 text-center transition-all bg-slate-50/50">
                    <input type="file"
                        wire:model="cvFile"
                        id="cv_upload_input"
                        accept="application/pdf"
                        class="hidden">

                    <label for="cv_upload_input" class="cursor-pointer block">
                        <div class="mx-auto w-12 h-12 rounded-2xl bg-blue-100/70 text-vinix-navy flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-vinix-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-vinix-navy hover:underline">
                            Pilih file PDF
                        </span>
                        <span class="text-sm text-slate-500"> atau seret ke sini</span>
                        <p class="text-xs text-slate-400 mt-1">Format PDF, ukuran maksimal 5 MB</p>
                    </label>

                    @if($cvFile)
                        <div class="mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl inline-flex items-center text-xs text-emerald-800 font-semibold">
                            <svg class="w-4 h-4 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            File terpilih: {{ $cvFile->getClientOriginalName() }}
                        </div>
                    @elseif($user->profile?->cv_path)
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-xl inline-flex items-center text-xs text-blue-800 font-semibold">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                            </svg>
                            CV sebelumnya telah diunggah. Unggah kembali jika ingin memperbarui.
                        </div>
                    @endif
                </div>
                @error('cvFile')
                    <span class="text-xs text-red-600 font-medium block mt-1">{{ $message }}</span>
                @enderror
                @error('selectedDivisionId')
                    <span class="text-xs text-red-600 font-medium block mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('applicant.assessment') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Ubah Jawaban Kuesioner
                </a>

                <button type="submit"
                    wire:loading.attr="disabled"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 rounded-xl text-sm font-bold text-slate-900 bg-gradient-to-r from-vinix-aurum via-yellow-400 to-amber-500 hover:from-yellow-400 hover:to-amber-600 active:scale-95 shadow-lg shadow-amber-500/25 transition-all duration-200">
                    <span wire:loading.remove>Kirim Lamaran ke HRD</span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-slate-900" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses Pengiriman...
                    </span>
                </button>
            </div>
        </form>
    </div>

    <!-- Collapsible Full 14 Divisions Ranking Table -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Peringkat Lengkap 14 Divisi Magang</h3>
                <p class="text-xs text-slate-500">Transparansi komputasi algoritma Simple Additive Weighting</p>
            </div>
            <button type="button"
                wire:click="toggleAllDivisions"
                class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                <span>{{ $showAllDivisions ? 'Sembunyikan' : 'Tampilkan Semua Peringkat' }}</span>
                <svg class="w-4 h-4 ml-1.5 transform transition-transform {{ $showAllDivisions ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        @if($showAllDivisions)
            <div class="overflow-x-auto pt-2">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 rounded-l-lg">Peringkat</th>
                            <th class="px-4 py-3">Nama Divisi</th>
                            <th class="px-4 py-3">Persentase SAW</th>
                            <th class="px-4 py-3 rounded-r-lg text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($allResults as $item)
                            <tr class="hover:bg-slate-50 transition {{ $item->rank <= 3 ? 'bg-amber-50/40 font-medium' : '' }}">
                                <td class="px-4 py-3 font-bold {{ $item->rank <= 3 ? 'text-amber-800' : 'text-slate-500' }}">
                                    #{{ $item->rank }}
                                </td>
                                <td class="px-4 py-3 text-slate-900 font-semibold">
                                    {{ $item->division->name }}
                                </td>
                                <td class="px-4 py-3 font-bold text-vinix-navy">
                                    {{ number_format($item->final_score, 2) }}%
                                </td>
                                <td class="px-4 py-3 text-right">
                                    @if($item->rank <= 3)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-900">
                                            Top 3 Rekomendasi
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">Alternatif</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
