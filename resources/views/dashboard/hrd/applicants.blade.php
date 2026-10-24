<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Data Pelamar Magang & Keputusan Seleksi
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Daftar seluruh pelamar terdaftar, hasil komputasi SAW, dan status penerimaan.
                </p>
            </div>
            <a href="{{ route('hrd.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Dashboard Analitik
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search & Filter Controls -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
            <form method="GET" action="{{ route('hrd.applicants') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email..."
                    class="rounded-xl border-slate-200 text-xs sm:text-sm focus:border-vinix-navy focus:ring-vinix-navy w-full sm:w-64">

                <select name="status" class="rounded-xl border-slate-200 text-xs sm:text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                    <option value="">Semua Status Lamaran</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu Review)</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved (Diterima)</option>
                    <option value="reassigned" {{ request('status') === 'reassigned' ? 'selected' : '' }}>Reassigned (Dialihkan)</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                    <option value="unsubmitted" {{ request('status') === 'unsubmitted' ? 'selected' : '' }}>Belum Submit Lamaran</option>
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition">
                    Filter
                </button>

                @if(request('search') || request('status'))
                    <a href="{{ route('hrd.applicants') }}" class="px-3 py-2 rounded-xl text-xs font-medium text-slate-500 hover:text-slate-800 transition">
                        Reset
                    </a>
                @endif
            </form>

            <span class="text-xs text-slate-400">Total: <strong>{{ $applicants->total() }}</strong> pelamar ditemukan</span>
        </div>

        <!-- Applicants Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-4">Pelamar</th>
                            <th class="px-5 py-4">Instansi & Kategori</th>
                            <th class="px-5 py-4">Pilihan / Diterima</th>
                            <th class="px-5 py-4">Top 1 Rekomendasi SAW</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($applicants as $appUser)
                            @php
                                $app = $appUser->application;
                                $top1 = $appUser->sawResults->first();
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-5 py-4">
                                    <div class="font-bold text-slate-900">{{ $appUser->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $appUser->email }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $appUser->profile?->phone ?? 'No WhatsApp -' }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-800">{{ $appUser->profile?->institution ?? '-' }}</div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold capitalize {{ $appUser->profile?->type === 'mahasiswa' ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $appUser->profile?->type ?? 'Mahasiswa' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    @if($app)
                                        <div class="text-xs">
                                            <span class="font-bold text-slate-800">{{ $app->selectedDivision->name }}</span>
                                            @if($app->approvedDivision && $app->approved_division_id !== $app->selected_division_id)
                                                <div class="text-blue-600 font-semibold mt-0.5 flex items-center">
                                                    &rarr; Dialihkan ke: {{ $app->approvedDivision->name }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum Mengajukan</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if($top1)
                                        <div class="flex items-center space-x-2">
                                            <span class="w-5 h-5 rounded-md bg-vinix-aurum text-slate-950 text-[10px] font-extrabold flex items-center justify-center">1</span>
                                            <span class="text-xs font-bold text-slate-800 truncate max-w-xs">{{ $top1->division->name }}</span>
                                            <span class="text-xs font-black text-vinix-navy">({{ number_format($top1->final_score, 1) }}%)</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Kuesioner belum lengkap</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if(!$app)
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600">
                                            Belum Submit
                                        </span>
                                    @elseif($app->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800">
                                            Pending Review
                                        </span>
                                    @elseif($app->status === 'approved')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                            Diterima
                                        </span>
                                    @elseif($app->status === 'reassigned')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-100 text-blue-800">
                                            Reassigned
                                        </span>
                                    @elseif($app->status === 'rejected')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('hrd.applicants.detail', $appUser->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition shadow-xs">
                                        Review & Keputusan &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-xs">
                                    Tidak ada data pelamar yang sesuai dengan filter pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($applicants->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $applicants->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
