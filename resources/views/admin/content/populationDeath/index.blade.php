@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8" x-data="deathTable()">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 flex items-center">
            Data Kematian Penduduk
            <span class="text-gray-400 ml-2">🪦</span>
        </h1>
        <a href="{{ route('kematian.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition flex items-center">
            <span class="mr-2">➕</span> Tambah Data
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search & Filters --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
        <div class="relative w-full md:w-1/3">
            <input x-model="search"
                   type="text"
                   placeholder="Cari nama, penyebab..."
                   class="w-full bg-white border border-gray-300 text-gray-700 placeholder-gray-500 rounded pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <span class="absolute left-3 top-2.5 text-gray-500">🔍</span>
        </div>
        <div class="flex space-x-2">
            <button @click="filterToday"
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded shadow transition">
                Hari Ini
            </button>
            <button @click="clearFilter"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-2 rounded shadow transition">
                Reset
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-gray-700">Nama Penduduk</th>
                    <th class="px-4 py-3 text-gray-700">Tanggal Meninggal</th>
                    <th class="px-4 py-3 text-gray-700">Penyebab</th>
                    <th class="px-4 py-3 text-gray-700">Keterangan</th>
                    <th class="px-4 py-3 text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="death in filtered" :key="death.id">
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-800" x-text="death.resident_name || '-'"></td>
                        <td class="px-4 py-3 text-gray-800" x-text="death.tanggal_meninggal"></td>
                        <td class="px-4 py-3 text-gray-800" x-text="death.penyebab"></td>
                        <td class="px-4 py-3 text-gray-800" x-text="death.keterangan"></td>
                        <td class="px-4 py-3 space-x-1">
                            <!-- Edit button -->
                            <a :href="`${baseUrl}/${death.id}/edit`"
                               class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded inline-block">
                                ✏️ Edit
                            </a>
                            <!-- Delete form -->
                            <form :action="`${baseUrl}/${death.id}`" method="POST"
                                  @submit.prevent="confirmDelete($event, death.id)" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </template>
                <tr x-show="filtered.length === 0">
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        Tidak ada data yang cocok 😢
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function deathTable() {
    return {
        search: '',
        // Base URL untuk membangun edit/delete
        baseUrl: '{{ route("kematian.index") }}',
        all: {!! collect($deaths)->map(fn($d) => [
            'id'                => $d->id,
            'resident_name'     => $d->resident->nama_lengkap ?? null,
            'tanggal_meninggal' => $d->tanggal_meninggal,
            'penyebab'          => $d->penyebab,
            'keterangan'        => $d->keterangan,
        ])->toJson() !!},
        get filtered() {
            let term = this.search.toLowerCase();
            return this.all.filter(d => {
                return !term
                    || d.resident_name?.toLowerCase().includes(term)
                    || d.penyebab.toLowerCase().includes(term)
                    || d.keterangan.toLowerCase().includes(term);
            });
        },
        filterToday() {
            const today = new Date().toISOString().slice(0,10);
            this.search = today;
        },
        clearFilter() {
            this.search = '';
        },
        confirmDelete(e, id) {
            if (confirm('Yakin hapus data ini?')) {
                e.target.submit();
            }
        }
    }
}
</script>
@endsection