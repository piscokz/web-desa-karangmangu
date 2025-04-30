<h1>Tambah RT</h1>
<!-- Form tambah RT -->
<form action="{{ route('rt.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nomor_rt">Nomor RT</label>
        <input type="text" name="nomor_rt" id="nomor_rt" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="id_rw">Nomor RW</label>
        <select name="id_rw" id="id_rw" class="form-control" required>
            <option value="">Pilih Rw</option>
            @foreach ($rws as $rw)
                <option value="{{ $rw->id }}">{{ $rw->nomor_rw }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('rt.index') }}" class="btn btn-secondary">Kembali</a>
</form>
