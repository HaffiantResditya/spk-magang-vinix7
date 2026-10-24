<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Dynamic Matrix Weights (W) Algoritma SAW
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Konfigurasi persentase bobot kriteria untuk 19 divisi magang tanpa mengubah source code aplikasi.
                </p>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Overview
            </a>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="matrixWeightsData()">
        <!-- Notice Card -->
        <div class="bg-amber-50/70 border border-vinix-aurum/40 rounded-2xl p-4 sm:p-5 flex items-start space-x-3.5">
            <div class="w-8 h-8 rounded-lg bg-vinix-aurum text-slate-950 flex items-center justify-center font-black flex-shrink-0 mt-0.5">
                W
            </div>
            <div class="text-xs sm:text-sm text-amber-900 leading-relaxed">
                <span class="font-bold">Panduan Bobot SAW:</span> Setiap baris divisi idealnya memiliki total akumulasi bobot kriteria (C1 s/d C7) sebesar <strong class="text-slate-900">100%</strong>. Kolom total di sebelah kanan akan berubah warna secara otomatis menjadi <span class="text-emerald-700 font-bold">hijau</span> saat mencapai 100%.
            </div>
        </div>

        <form method="POST" action="{{ route('superadmin.matrix-weights.update') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="text-[11px] font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3.5 w-12 text-center">No</th>
                                <th class="px-4 py-3.5 min-w-[220px]">Divisi Magang</th>
                                @foreach($criteria as $c)
                                    <th class="px-3 py-3.5 text-center min-w-[95px]" title="{{ $c->name }}">
                                        <span class="block text-vinix-navy font-black">{{ $c->code }}</span>
                                        <span class="text-[9px] text-slate-400 font-medium truncate block max-w-[90px]">{{ $c->name }}</span>
                                    </th>
                                @endforeach
                                <th class="px-4 py-3.5 text-center min-w-[110px]">Total Bobot</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($divisions as $divIndex => $div)
                                @php
                                    $weightsByCrit = $div->matrixWeights->pluck('weight_percentage', 'criteria_id')->toArray();
                                @endphp
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-4 py-3 text-center font-bold text-slate-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-slate-900">
                                        <span class="block">{{ $div->name }}</span>
                                    </td>
                                    @foreach($criteria as $crit)
                                        @php
                                            $val = $weightsByCrit[$crit->id] ?? 0;
                                        @endphp
                                        <td class="px-2 py-2 text-center">
                                            <div class="relative inline-block w-full">
                                                <input type="number"
                                                    step="0.5"
                                                    min="0"
                                                    max="100"
                                                    name="weights[{{ $div->id }}][{{ $crit->id }}]"
                                                    value="{{ $val }}"
                                                    x-model.number="weights[{{ $div->id }}][{{ $crit->id }}]"
                                                    @input="recalculateRow({{ $div->id }})"
                                                    class="w-20 text-center py-1.5 px-1 rounded-lg border-slate-200 text-xs font-bold text-slate-800 focus:border-vinix-navy focus:ring-vinix-navy">
                                                <span class="text-[10px] text-slate-400 ml-0.5">%</span>
                                            </div>
                                        </td>
                                    @endforeach
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black transition-colors"
                                            :class="isHundred({{ $div->id }}) ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-amber-100 text-amber-800 border border-amber-300'">
                                            <span x-text="getRowTotal({{ $div->id }})"></span>%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-100 bg-slate-50/60 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-slate-500">
                        Pastikan seluruh 19 divisi terkonfigurasi dengan tepat sebelum menyimpan perubahan.
                    </span>
                    <button type="submit" class="px-7 py-3 rounded-xl text-xs sm:text-sm font-extrabold text-slate-950 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 active:scale-95 shadow-lg shadow-amber-500/25 transition">
                        Simpan Seluruh Matriks Bobot SAW
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function matrixWeightsData() {
            return {
                weights: {
                    @foreach($divisions as $div)
                        {{ $div->id }}: {
                            @foreach($criteria as $crit)
                                {{ $crit->id }}: {{ $div->matrixWeights->where('criteria_id', $crit->id)->first()?->weight_percentage ?? 0 }},
                            @endforeach
                        },
                    @endforeach
                },
                recalculateRow(divId) {
                    // triggered on input
                },
                getRowTotal(divId) {
                    if (!this.weights[divId]) return 0;
                    let sum = 0;
                    for (let cId in this.weights[divId]) {
                        sum += parseFloat(this.weights[divId][cId]) || 0;
                    }
                    return Math.round(sum * 10) / 10;
                },
                isHundred(divId) {
                    return Math.abs(this.getRowTotal(divId) - 100.0) < 0.01;
                }
            };
        }
    </script>
</x-app-layout>
