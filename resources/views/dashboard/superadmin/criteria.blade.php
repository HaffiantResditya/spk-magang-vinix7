<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    7 Kriteria & 18 Pertanyaan Kuesioner
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Instrumen penilaian mandiri pelamar untuk komputasi algoritma SAW.
                </p>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Overview
            </a>
        </div>
    </x-slot>

    <div class="space-y-8" x-data="{ addModal: false, editModal: false, editId: null, editCritId: 1, editText: '', editOrder: 1 }">
        <!-- Criteria Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($criteria as $c)
                <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <span class="px-2 py-0.5 rounded text-[11px] font-black bg-vinix-navy text-white">
                            {{ $c->code }}
                        </span>
                        <h4 class="font-bold text-slate-800 text-sm mt-1.5 line-clamp-1">{{ $c->name }}</h4>
                        <span class="text-[11px] text-slate-400 capitalize">Sifat: {{ $c->type }}</span>
                    </div>
                    <span class="text-xs font-bold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-lg">
                        {{ $c->questions->count() }} Soal
                    </span>
                </div>
            @endforeach
        </div>

        <!-- Questions Section -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Daftar Pertanyaan Asesmen</h3>
                    <p class="text-xs text-slate-400">Total 18 instrumen soal self-assessment pelamar</p>
                </div>
                <button @click="addModal = true" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition shadow-xs">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pertanyaan
                </button>
            </div>

            <div class="space-y-6">
                @foreach($criteria as $crit)
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/70 space-y-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-black bg-vinix-navy text-white">{{ $crit->code }}</span>
                            <span class="font-bold text-slate-800 text-sm">{{ $crit->name }}</span>
                        </div>

                        <div class="space-y-2 pt-1">
                            @foreach($crit->questions as $q)
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200 flex items-start justify-between gap-4">
                                    <div class="flex items-start space-x-2.5">
                                        <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-700 text-xs font-bold flex items-center justify-center flex-shrink-0 mt-0.5">
                                            {{ $q->order_num }}
                                        </span>
                                        <span class="text-xs text-slate-800 leading-snug">{{ $q->question_text }}</span>
                                    </div>
                                    <div class="flex-shrink-0 space-x-2">
                                        <button @click="editModal = true; editId = {{ $q->id }}; editCritId = {{ $q->criteria_id }}; editText = '{{ addslashes($q->question_text) }}'; editOrder = {{ $q->order_num }}"
                                            class="text-xs font-bold text-blue-600 hover:underline">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('superadmin.questions.destroy', $q->id) }}" class="inline" onsubmit="return confirm('Hapus pertanyaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-bold text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Question Modal -->
        <div x-show="addModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
            <div @click.outside="addModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 space-y-4">
                <h3 class="text-lg font-bold text-slate-900">Tambah Pertanyaan Kuesioner Baru</h3>
                <form method="POST" action="{{ route('superadmin.questions.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kriteria</label>
                        <select name="criteria_id" required class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                            @foreach($criteria as $c)
                                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor Urut Soal</label>
                        <input type="number" name="order_num" value="{{ $criteria->flatMap->questions->count() + 1 }}" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Teks Pertanyaan</label>
                        <textarea name="question_text" rows="3" required placeholder="Tuliskan instrumen pertanyaan..."
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy"></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-3">
                        <button type="button" @click="addModal = false" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800">Batal</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-vinix-navy rounded-xl hover:bg-blue-900 transition">Simpan Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Question Modal -->
        <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
            <div @click.outside="editModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 space-y-4">
                <h3 class="text-lg font-bold text-slate-900">Edit Pertanyaan Kuesioner</h3>
                <form :action="'{{ url('superadmin/questions') }}/' + editId" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kriteria</label>
                        <select name="criteria_id" x-model="editCritId" required class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                            @foreach($criteria as $c)
                                <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor Urut Soal</label>
                        <input type="number" name="order_num" x-model="editOrder" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Teks Pertanyaan</label>
                        <textarea name="question_text" rows="3" x-model="editText" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy"></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-3">
                        <button type="button" @click="editModal = false" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800">Batal</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-vinix-navy rounded-xl hover:bg-blue-900 transition">Perbarui Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
