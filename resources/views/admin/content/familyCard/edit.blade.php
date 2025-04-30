
<!-- Blade: resources/views/admin/content/familyCard/edit.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Edit Kartu Keluarga')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6 space-x-4">
        <img src="{{ asset('images/logo-kuningan.png') }}" alt="Logo Kuningan" class="h-12">
        <h1 class="text-2xl font-bold">Edit Kartu Keluarga - {{ $kartuKeluarga->no_kk }}</h1>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('kk.update', $kartuKeluarga->id) }}" method="POST" class="space-y-4 bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')
        <div>
            <label for="no_kk" class="block text-sm font-medium text-gray-700">No. Kartu Keluarga</label>
            <input type="text" name="no_kk" id="no_kk" required
                   value="{{ $kartuKeluarga->no_kk }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="id_dusun" class="block text-sm font-medium text-gray-700">Dusun</label>
                <select name="id_dusun" id="id_dusun" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>Pilih Dusun</option>
                    @foreach($dusuns as $dusun)
                        <option value="{{ $dusun->id }}" {{ $kartuKeluarga->id_dusun == $dusun->id ? 'selected' : '' }}>{{ $dusun->nama_dusun }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_rw" class="block text-sm font-medium text-gray-700">RW</label>
                <select name="id_rw" id="id_rw" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>Pilih RW</option>
                    @foreach($dusuns as $dusun)
                        @foreach($dusun->rws as $rw)
                            <option value="{{ $rw->id }}" data-dusun="{{ $dusun->id }}" {{ $kartuKeluarga->id_rw == $rw->id ? 'selected' : '' }}>RW {{ $rw->nomor_rw }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_rt" class="block text-sm font-medium text-gray-700">RT</label>
                <select name="id_rt" id="id_rt" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled>Pilih RT</option>
                    @foreach($dusuns as $dusun)
                        @foreach($dusun->rws as $rw)
                            @foreach($rw->rts as $rt)
                                <option value="{{ $rt->id }}" data-rw="{{ $rw->id }}" {{ $kartuKeluarga->id_rt == $rt->id ? 'selected' : '' }}>RT {{ $rt->nomor_rt }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Perbarui</button>
            <a href="{{ route('kk.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const dusun = document.getElementById('id_dusun');
    const rw = document.getElementById('id_rw');
    const rt = document.getElementById('id_rt');

    function filter(selectEl, attr, val) {
        Array.from(selectEl.options).forEach(o => {
            o.hidden = o.hasAttribute(attr) && о.getAttribute(attr) !== val;
        });
    }

    dusun.addEventListener('change', () => {
        filter(rw, 'data-dusun', dusun.value);
        rw.value = '';
        rt.value = '';
        filter(rt, 'data-rw', '');
    });

    rw.addEventListener('change', () => {
        filter(rt, 'data-rw', rw.value);
        rt.value = '';
    });

    // initial
    filter(rw, 'data-dusun', dusun.value);
    filter(rt, 'data-rw', rw.value);
});
</script>

@endsection