<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;

class RtController extends Controller
{
    // Menampilkan daftar semua RT
    public function index(Request $request)
    {
        $query = Rt::with('rw');
    
        if ($search = $request->input('search')) {
            $query->where('nomor_rt', 'like', "%{$search}%")
                  ->orWhereHas('rw', function($q) use ($search) {
                      $q->where('nomor_rw', 'like', "%{$search}%");
                  });
        }
    
        $rts = $query->paginate(10);
        return view('admin.content.rt.index', compact('rts'));
    }
    
    // Menampilkan form untuk menambah RT
    public function create()
    {
        $rws = Rw::all();  // Ambil semua data RW
        return view('admin.content.rt.create', compact('rws'));  // Tampilkan form input
    }

    // Menyimpan data RT baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nomor_rt' => 'required|string|max:255',  // nomor RT wajib diisi
            'id_rw' => 'required|exists:rws,id',  // ID Rw wajib ada dan valid
            // 'alamat' => 'required|string|max:500',  // Alamat wajib diisi dan maksimal 500 karakter
        ]);

        // Simpan data RT ke database
        Rt::create($request->all());

        // Redirect ke halaman daftar RT dengan pesan sukses
        return redirect()->route('rt.index')->with('success', 'RT berhasil ditambahkan!');
    }

    // Menampilkan data RT tertentu berdasarkan ID
    public function show($id)
    {
        $rt = Rt::findOrFail($id);  // Cari data RT berdasarkan ID
        return view('admin.content.rt.show', compact('rt'));  // Kirim data ke view
    }

    // Menampilkan form untuk mengedit data RT
    public function edit($id)
    {
        $rt = Rt::findOrFail($id);  // Ambil data RT berdasarkan ID
        $rws = Rw::all();  // Ambil semua data RW
        return view('admin.content.rt.edit', compact('rt', 'rws'));  // Kirim data ke form edit
    }

    // Mengupdate data RT berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'nomor_rt' => 'required|string|max:255',  // nomor RT wajib diisi
            'id_rw' => 'required|exists:rws,id',  // ID Dusun wajib ada dan valid
            // 'alamat' => 'required|string|max:500',  // Alamat wajib diisi dan maksimal 500 karakter
        ]);

        // Cari RT berdasarkan ID dan update data
        $rt = Rt::findOrFail($id);
        $rt->update($request->all());

        // Redirect ke halaman daftar RT dengan pesan sukses
        return redirect()->route('rt.index')->with('success', 'RT berhasil diperbarui!');
    }

    // Menghapus data RT berdasarkan ID
    public function destroy($id)
    {
        // Cari RT berdasarkan ID dan hapus
        $rt = Rt::findOrFail($id);
        $rt->delete();

        // Redirect ke halaman daftar RT dengan pesan sukses
        return redirect()->route('rt.index')->with('success', 'RT berhasil dihapus!');
    }
}
