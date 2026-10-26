<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Evaluasi & Keputusan Seleksi Pelamar
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pelamar: <span class="font-bold text-slate-800">{{ $applicant->name }}</span> ({{ $applicant->email }})
                </p>
            </div>
            <a href="{{ route('hrd.applicants') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Daftar Pelamar
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Applicant Profile & Status Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Biodata Pelamar</h3>
                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-slate-400 block font-medium">Nama Lengkap</span>
                        <span class="font-bold text-slate-800 text-sm">{{ $applicant->name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Email</span>
                        <span class="font-medium text-slate-700">{{ $applicant->email }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Status & Instansi</span>
                        <span class="font-bold text-slate-800 capitalize">{{ $applicant->profile?->type ?? 'Mahasiswa' }}</span>
                        <span class="text-slate-500 block">{{ $applicant->profile?->institution ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">No. WhatsApp</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $applicant->profile?->phone ?? '') }}" target="_blank" class="font-bold text-emerald-600 hover:underline">
                            {{ $applicant->profile?->phone ?? '-' }}
                        </a>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium mb-1">Dokumen CV (PDF)</span>
                        @if($applicant->profile?->cv_path)
                            <a href="{{ $applicant->profile->cv_url }}" target="_blank"
                                class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition shadow-xs">
                                <svg class="w-4 h-4 mr-1.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                Buka File CV PDF
                            </a>
                        @else
                            <span class="text-slate-400 italic">Pelamar belum mengunggah CV</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Decision Execution Form Card (Span 2) -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Form Keputusan Rekrutmen HRD</h3>
                        <p class="text-xs text-slate-400">Eksekusi penerimaan, pengalihan divisi (reassign), atau penolakan</p>
                    </div>
                    @if($applicant->application)
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $applicant->application->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : ($applicant->application->status === 'reassigned' ? 'bg-blue-100 text-blue-800' : ($applicant->application->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800')) }}">
                            Status: {{ $applicant->application->status }}
                        </span>
                    @endif
                </div>

                @if($applicant->application)
                    <form method="POST" action="{{ route('hrd.applicants.updateStatus', $applicant->application->id) }}" class="space-y-4"
                        onsubmit="event.preventDefault(); window.confirmDialog({ title: 'Simpan Keputusan Seleksi?', text: 'Keputusan status pelamar (Approve/Reassign/Reject) akan disimpan dan langsung diperbarui di portal pelamar.', icon: 'question', confirmText: 'Ya, Simpan Keputusan', confirmColor: '#0F172A' }).then(res => { if(res.isConfirmed) this.submit(); });">
                        @csrf
                        @method('PUT')

                        <div>
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Tindakan Seleksi</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-center space-x-2.5 has-checked:border-emerald-500 has-checked:bg-emerald-50/50 has-checked:ring-2 has-checked:ring-emerald-500/20">
                                    <input type="radio" name="status" value="approved" class="text-emerald-600 focus:ring-emerald-500" {{ old('status', $applicant->application->status) === 'approved' ? 'checked' : '' }}>
                                    <div>
                                        <span class="text-xs font-bold text-slate-900 block">Approve</span>
                                        <span class="text-[11px] text-slate-400">Diterima di pilihan pelamar</span>
                                    </div>
                                </label>

                                <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-center space-x-2.5 has-checked:border-blue-500 has-checked:bg-blue-50/50 has-checked:ring-2 has-checked:ring-blue-500/20">
                                    <input type="radio" name="status" value="reassigned" class="text-blue-600 focus:ring-blue-500" {{ old('status', $applicant->application->status) === 'reassigned' ? 'checked' : '' }}>
                                    <div>
                                        <span class="text-xs font-bold text-slate-900 block">Reassign</span>
                                        <span class="text-[11px] text-slate-400">Diterima di divisi alternatif</span>
                                    </div>
                                </label>

                                <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-center space-x-2.5 has-checked:border-red-500 has-checked:bg-red-50/50 has-checked:ring-2 has-checked:ring-red-500/20">
                                    <input type="radio" name="status" value="rejected" class="text-red-600 focus:ring-red-500" {{ old('status', $applicant->application->status) === 'rejected' ? 'checked' : '' }}>
                                    <div>
                                        <span class="text-xs font-bold text-slate-900 block">Reject</span>
                                        <span class="text-[11px] text-slate-400">Ditolak</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="approved_division_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Divisi Penempatan Akhir (Wajib jika Reassign / Opsional jika Approve)
                            </label>
                            <select name="approved_division_id" id="approved_division_id" class="w-full rounded-xl border-slate-200 text-xs sm:text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                                <option value="">-- Gunakan Pilihan Pelamar ({{ $applicant->application->selectedDivision->name }}) --</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ old('approved_division_id', $applicant->application->approved_division_id) == $div->id ? 'selected' : '' }}>
                                        {{ $div->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="hrd_notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Catatan HRD / Alasan Penempatan (Akan tampil pada portal pelamar)
                            </label>
                            <textarea name="hrd_notes" id="hrd_notes" rows="2" placeholder="Tuliskan catatan pertimbangan kuota, hasil wawancara, atau instruksi onboarding..."
                                class="w-full rounded-xl border-slate-200 text-xs sm:text-sm focus:border-vinix-navy focus:ring-vinix-navy">{{ old('hrd_notes', $applicant->application->hrd_notes) }}</textarea>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-vinix-navy hover:bg-blue-900 active:scale-95 transition shadow-sm">
                                Simpan Keputusan Seleksi
                            </button>
                        </div>
                    </form>
                @else
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl text-center text-xs text-slate-500">
                        Pelamar ini belum melakukan submit final lamaran. Evaluasi nilai dan jawaban SAW di bawah dapat dijadikan referensi awal.
                    </div>
                @endif
            </div>
        </div>

        <!-- SAW Ranking Table (Top 3 & All 14 Divisions) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Hasil Perhitungan Algoritma SAW</h3>
                    <p class="text-xs text-slate-400">Peringkat preferensi 14 divisi magang berdasarkan perkalian matriks R dengan bobot W</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                @foreach($sawData['top3'] as $top)
                    <div class="p-4 rounded-2xl border {{ $top['rank'] === 1 ? 'bg-amber-50/70 border-vinix-aurum ring-2 ring-vinix-aurum/20' : 'bg-slate-50 border-slate-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase {{ $top['rank'] === 1 ? 'bg-vinix-aurum text-slate-950' : 'bg-slate-200 text-slate-700' }}">
                                Rekomendasi #{{ $top['rank'] }}
                            </span>
                            <span class="text-lg font-black text-vinix-navy">{{ number_format($top['final_score'], 2) }}%</span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">{{ $top['division_name'] }}</h4>
                    </div>
                @endforeach
            </div>

            <!-- Full Ranking Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="text-[11px] font-bold text-slate-400 uppercase bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-4 py-2.5">Peringkat</th>
                            <th class="px-4 py-2.5">Nama Divisi</th>
                            <th class="px-4 py-2.5">Skor Preferensi (V)</th>
                            <th class="px-4 py-2.5">Kontribusi Bobot Kriteria (C1 - C7)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($sawData['all_results'] as $res)
                            <tr class="hover:bg-slate-50/80 transition {{ $res['rank'] <= 3 ? 'bg-amber-50/30' : '' }}">
                                <td class="px-4 py-3 font-bold {{ $res['rank'] <= 3 ? 'text-amber-800' : 'text-slate-500' }}">
                                    #{{ $res['rank'] }}
                                </td>
                                <td class="px-4 py-3 font-semibold text-slate-900">
                                    {{ $res['division_name'] }}
                                </td>
                                <td class="px-4 py-3 font-extrabold text-vinix-navy">
                                    {{ number_format($res['final_score'], 2) }}%
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1.5 text-[10px]">
                                        @foreach($res['breakdown'] as $code => $bd)
                                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 border border-slate-200" title="W: {{ $bd['weight'] }}%, Score: {{ $bd['raw_score'] }}">
                                                {{ $code }}: {{ $bd['contribution'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Raw Answers 18 Questions Grouped by Criteria -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-lg font-bold text-slate-900">Detail Skor Mentah 18 Soal Kuesioner (C1 - C7)</h3>
                <p class="text-xs text-slate-400">Verifikasi transparansi jawaban yang diisi oleh pelamar</p>
            </div>

            <div class="space-y-6">
                @foreach($criteria as $crit)
                    @php
                        $critScore = $sawData['criteria_scores'][$crit->code] ?? 0;
                        $critR = $sawData['normalized_matrix'][$crit->code] ?? 0;
                    @endphp
                    <div class="p-5 rounded-2xl bg-slate-50/60 border border-slate-200 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200/70 pb-3">
                            <div class="flex items-center space-x-2.5">
                                <span class="px-2.5 py-1 rounded-md text-xs font-extrabold bg-vinix-navy text-white">
                                    {{ $crit->code }}
                                </span>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $crit->name }}</h4>
                            </div>
                            <div class="flex items-center space-x-4 text-xs font-semibold">
                                <span class="text-slate-600">Rata-rata (X): <strong class="text-slate-900">{{ $critScore }}</strong></span>
                                <span class="text-vinix-navy">Normalisasi (R): <strong>{{ $critR }}</strong></span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            @foreach($crit->questions as $q)
                                @php
                                    $ans = $q->answers->first()?->score_value ?? '-';
                                @endphp
                                <div class="flex items-start justify-between gap-4 text-xs bg-white p-3 rounded-xl border border-slate-100">
                                    <div class="flex items-start space-x-2">
                                        <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                            {{ $q->order_num }}
                                        </span>
                                        <span class="text-slate-700 leading-snug">{{ $q->question_text }}</span>
                                    </div>
                                    <div class="flex-shrink-0 text-right">
                                        <span class="px-2.5 py-1 rounded-lg font-black text-xs {{ $ans >= 80 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($ans >= 60 ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-700') }}">
                                            Skor: {{ $ans }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
