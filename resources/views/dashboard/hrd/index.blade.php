<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Dashboard Analitik HRD
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pemantauan metrik seleksi & komputasi kompas karir magang PT Vinix Seven Aurum.
                </p>
            </div>
            <div>
                <a href="{{ route('hrd.applicants') }}" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition shadow-xs">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Lihat Semua Pelamar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Stats Summary Grid -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Akun Pelamar</span>
                <span class="text-2xl sm:text-3xl font-black text-slate-900 mt-1 block">{{ $totalApplicants }}</span>
                <span class="text-[11px] text-slate-400 mt-1 block">Terdaftar di sistem</span>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Lamaran Masuk</span>
                <span class="text-2xl sm:text-3xl font-black text-blue-900 mt-1 block">{{ $totalSubmitted }}</span>
                <span class="text-[11px] text-slate-400 mt-1 block">Submit final & CV</span>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-amber-200/80 shadow-xs bg-amber-50/30">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider block">Menunggu Review</span>
                <span class="text-2xl sm:text-3xl font-black text-amber-700 mt-1 block">{{ $totalPending }}</span>
                <span class="text-[11px] text-amber-600 mt-1 block">Perlu verifikasi HRD</span>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-emerald-200/80 shadow-xs bg-emerald-50/30">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block">Total Diterima</span>
                <span class="text-2xl sm:text-3xl font-black text-emerald-700 mt-1 block">{{ $totalApproved }}</span>
                <span class="text-[11px] text-emerald-600 mt-1 block">Approved & Reassigned</span>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-red-200/80 shadow-xs bg-red-50/30">
                <span class="text-xs font-bold text-red-700 uppercase tracking-wider block">Ditolak</span>
                <span class="text-2xl sm:text-3xl font-black text-red-700 mt-1 block">{{ $totalRejected }}</span>
                <span class="text-[11px] text-red-600 mt-1 block">Tidak lolos kualifikasi</span>
            </div>
        </div>

        <!-- Demographics & Top Divisions Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left: Demografi Pelamar (Mahasiswa vs Umum) -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Demografi Kategori Pelamar</h3>
                        <p class="text-xs text-slate-400">Komposisi status pelamar terdaftar</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-vinix-navy">
                        {{ $mahasiswaCount + $umumCount }} Profil
                    </span>
                </div>

                <div class="space-y-5">
                    @php
                        $demTotal = max(1, $mahasiswaCount + $umumCount);
                        $mhsPct = round(($mahasiswaCount / $demTotal) * 100);
                        $umumPct = round(($umumCount / $demTotal) * 100);
                    @endphp

                    <!-- Progress bar -->
                    <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden flex">
                        <div class="bg-vinix-navy h-full transition-all duration-500" style="width: {{ $mhsPct }}%"></div>
                        <div class="bg-vinix-aurum h-full transition-all duration-500" style="width: {{ $umumPct }}%"></div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-blue-50/60 border border-blue-100">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 rounded-full bg-vinix-navy"></span>
                                <span class="text-xs font-bold text-slate-700">Mahasiswa Aktif</span>
                            </div>
                            <span class="text-2xl font-black text-vinix-navy mt-2 block">{{ $mahasiswaCount }}</span>
                            <span class="text-xs text-slate-500">{{ $mhsPct }}% dari total</span>
                        </div>

                        <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-100">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 rounded-full bg-vinix-aurum"></span>
                                <span class="text-xs font-bold text-slate-700">Umum / Fresh Grad</span>
                            </div>
                            <span class="text-2xl font-black text-amber-800 mt-2 block">{{ $umumCount }}</span>
                            <span class="text-xs text-slate-500">{{ $umumPct }}% dari total</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Top 5 Rekomendasi SAW Terbanyak -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="text-lg font-bold text-slate-900">Divisi Paling Sering Direkomendasikan</h3>
                    <p class="text-xs text-slate-400">Hasil peringkat 1 algoritma SAW pada pelamar</p>
                </div>

                <div class="space-y-3.5">
                    @forelse($topDivisions as $item)
                        <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-200/60">
                            <div class="flex items-center space-x-3">
                                <span class="w-7 h-7 rounded-lg bg-vinix-navy text-white text-xs font-bold flex items-center justify-center">
                                    {{ $loop->iteration }}
                                </span>
                                <div>
                                    <span class="text-sm font-bold text-slate-800 block">{{ $item->division->name }}</span>
                                    <span class="text-[11px] text-slate-400">Direkomendasikan {{ $item->count }} kali</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900">
                                {{ $item->count }} Pelamar
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8 text-xs text-slate-400">
                            Belum ada data komputasi SAW pelamar.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Applications Table -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Pengajuan Lamaran Magang Terbaru</h3>
                    <p class="text-xs text-slate-400">Daftar submit final pelamar yang memerlukan tindakan</p>
                </div>
                <a href="{{ route('hrd.applicants') }}" class="text-xs font-bold text-vinix-navy hover:underline">
                    Buka Semua Pelamar &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs font-bold text-slate-400 uppercase bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-4 py-3">Nama Pelamar</th>
                            <th class="px-4 py-3">Instansi / Status</th>
                            <th class="px-4 py-3">Divisi Diajukan</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentApplications as $app)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-4 py-3.5">
                                    <div class="font-bold text-slate-900">{{ $app->user->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $app->user->email }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-xs text-slate-700 block font-medium">{{ $app->user->profile?->institution ?? '-' }}</span>
                                    <span class="text-[11px] text-slate-400 capitalize">{{ $app->user->profile?->type ?? 'Mahasiswa' }}</span>
                                </td>
                                <td class="px-4 py-3.5 font-semibold text-slate-800">
                                    {{ $app->selectedDivision->name }}
                                </td>
                                <td class="px-4 py-3.5">
                                    @if($app->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @elseif($app->status === 'approved')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                            Diterima
                                        </span>
                                    @elseif($app->status === 'reassigned')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800">
                                            Reassigned
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-right">
                                    <a href="{{ route('hrd.applicants.detail', $app->user_id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold text-vinix-navy bg-blue-50 hover:bg-blue-100 transition">
                                        Review Detail &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-xs text-slate-400">
                                    Belum ada lamaran final yang dikirimkan pelamar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
