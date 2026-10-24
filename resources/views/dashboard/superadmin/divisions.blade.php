<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Master Data 19 Divisi Magang
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Kelola daftar divisi magang IT & Bisnis di PT Vinix Seven Aurum.
                </p>
            </div>
            <a href="{{ route('superadmin.dashboard') }}" class="text-xs font-semibold text-slate-500 hover:text-vinix-navy">
                &larr; Kembali ke Overview
            </a>
        </div>
    </x-slot>

    <div class="space-y-6" x-data="{ createModal: false, editModal: false, editId: null, editName: '', editDesc: '' }">
        <!-- Action Header -->
        <div class="flex items-center justify-between">
            <span class="text-xs text-slate-500">Total <strong>{{ $divisions->count() }}</strong> divisi terdaftar</span>
            <button @click="createModal = true" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold text-white bg-vinix-navy hover:bg-blue-900 transition shadow-xs">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Divisi Baru
            </button>
        </div>

        <!-- Divisions Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs font-bold text-slate-500 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 w-16">No</th>
                            <th class="px-5 py-3.5">Nama Divisi</th>
                            <th class="px-5 py-3.5">Deskripsi</th>
                            <th class="px-5 py-3.5 text-center">Titik Bobot</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($divisions as $div)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-5 py-3.5 font-bold text-slate-400">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-3.5 font-bold text-slate-900">
                                    {{ $div->name }}
                                </td>
                                <td class="px-5 py-3.5 text-xs text-slate-500 max-w-md">
                                    {{ $div->description }}
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-800">
                                        {{ $div->matrix_weights_count }} Bobot
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right space-x-2">
                                    <button @click="editModal = true; editId = {{ $div->id }}; editName = '{{ addslashes($div->name) }}'; editDesc = '{{ addslashes($div->description) }}'"
                                        class="text-xs font-bold text-blue-600 hover:underline">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('superadmin.divisions.destroy', $div->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Modal -->
        <div x-show="createModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
            <div @click.outside="createModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100 space-y-4">
                <h3 class="text-lg font-bold text-slate-900">Tambah Divisi Magang Baru</h3>
                <form method="POST" action="{{ route('superadmin.divisions.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Divisi</label>
                        <input type="text" name="name" required placeholder="Contoh: Mobile Developer"
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Deskripsi Divisi</label>
                        <textarea name="description" rows="3" placeholder="Tuliskan fokus pekerjaan dan lingkup divisi..."
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy"></textarea>
                    </div>
                    <div class="flex items-center justify-end space-x-3 pt-3">
                        <button type="button" @click="createModal = false" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800">Batal</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-vinix-navy rounded-xl hover:bg-blue-900 transition">Simpan Divisi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
            <div @click.outside="editModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100 space-y-4">
                <h3 class="text-lg font-bold text-slate-900">Edit Data Divisi Magang</h3>
                <form :action="'{{ url('superadmin/divisions') }}/' + editId" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Divisi</label>
                        <input type="text" name="name" x-model="editName" required
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Deskripsi Divisi</label>
                        <textarea name="description" rows="3" x-model="editDesc"
                            class="w-full rounded-xl border-slate-200 text-sm focus:border-vinix-navy focus:ring-vinix-navy"></textarea>
                    </div>
                    <div class="flex items-center justify-end space-x-3 pt-3">
                        <button type="button" @click="editModal = false" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:text-slate-800">Batal</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-vinix-navy rounded-xl hover:bg-blue-900 transition">Perbarui Divisi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
