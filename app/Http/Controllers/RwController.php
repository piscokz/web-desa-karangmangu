<?php

namespace App\Http\Controllers;

use App\Models\Hamlet;
use App\Models\Rw;
use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rw::with('hamlet')->latest();

        if ($request->has('search') && $request->search != '') {
            $query->where('nomor_rw', 'like', '%' . $request->search . '%');
        }

        $rws = $query->paginate(10); // Ambil semua data RW dengan pagination
        return view('admin.content.rw.index', compact('rws')); // Kirim data ke view
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dusuns = Hamlet::latest()->get();  // Ambil semua data Dusun
        return view('admin.content.rw.create', compact('dusuns'));  // Tampilkan form input
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nomor_rw' => 'required|string|max:255',  // Nomor RW wajib diisi
            'id_dusun' => 'required|exists:hamlets,id',  // ID Dusun wajib ada dan valid
            // 'alamat' => 'required|string|max:500',  // Alamat wajib diisi dan maksimal 500 karakter
        ]);

        // Simpan data RW ke database
        Rw::create($request->all());

        // Redirect ke halaman daftar RW dengan pesan sukses
        return redirect()->route('rw.index')->with('success', 'RW berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rw = Rw::findOrFail($id);  // Cari data RW berdasarkan ID
        return view('admin.content.rw.show', compact('rw'));  // Kirim data ke view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rw = Rw::findOrFail($id);  // Cari data RW berdasarkan ID
        $dusuns = Hamlet::latest()->get();  // Ambil semua data Dusun
        return view('admin.content.rw.edit', compact('rw', 'dusuns'));  // Tampilkan form edit dengan data RW
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inputan
        $request->validate([
            'nomor_rw' => 'required|string|max:255',  // Nomor RW wajib diisi
            'id_dusun' => 'required|exists:hamlets,id',  // ID Dusun wajib ada dan valid
            // 'alamat' => 'required|string|max:500',  // Alamat wajib diisi dan maksimal 500 karakter
        ]);

        // Cari RW berdasarkan ID dan update data
        $rw = Rw::findOrFail($id);
        $rw->update($request->all());

        // Redirect ke halaman daftar RW dengan pesan sukses
        return redirect()->route('rw.index')->with('success', 'RW berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari RW berdasarkan ID dan hapus
        $rw = Rw::findOrFail($id);
        $rw->delete();

        // Redirect ke halaman daftar RW dengan pesan sukses
        return redirect()->route('rw.index')->with('success', 'RW berhasil dihapus!');
    }
}
