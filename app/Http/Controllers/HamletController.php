<?php

namespace App\Http\Controllers;

use App\Models\Hamlet;
use Illuminate\Http\Request;

class HamletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil keyword dari query string ?search=...
        $keyword = $request->get('search');

        // Query model dengan kondisi jika ada keyword
        $dusuns = Hamlet::when($keyword, function ($query, $keyword) {
            return $query->where('nama_dusun', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(10)
            // Pastikan query string 'search' tetap ada di pagination links
            ->appends(['search' => $keyword]);

        return view('admin.content.hamlet.index', compact('dusuns', 'keyword'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.hamlet.create'); // Tampilkan form input
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_dusun' => 'required|string|max:255', // Nama Dusun wajib diisi
        ]);

        // Simpan data Dusun ke database
        Hamlet::create($request->all());

        // Redirect ke halaman daftar Dusun dengan pesan sukses
        return redirect()->route('dusun.index')->with('success', 'Dusun berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dusun = Hamlet::findOrFail($id); // Cari data Dusun berdasarkan ID
        return view('admin.content.hamlet.edit', compact('dusun')); // Tampilkan form edit dengan data Dusun
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inputan
        $request->validate([
            'nama_dusun' => 'required|string|max:255', // Nama Dusun wajib diisi
        ]);

        // Cari Dusun berdasarkan ID dan update data
        $dusun = Hamlet::findOrFail($id);
        $dusun->update($request->all());

        // Redirect ke halaman daftar Dusun dengan pesan sukses
        return redirect()->route('dusun.index')->with('success', 'Dusun berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari Dusun berdasarkan ID dan hapus
        $dusun = Hamlet::findOrFail($id);
        $dusun->delete();

        // Redirect ke halaman daftar Dusun dengan pesan sukses
        return redirect()->route('dusun.index')->with('success', 'Dusun berhasil dihapus!');
    }
}