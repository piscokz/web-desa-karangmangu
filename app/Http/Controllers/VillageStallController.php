<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\VillageStall;
use Illuminate\Http\Request;

class VillageStallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapak = VillageStall::with('resident')->get();
        return view('admin.content.village_stalls.index', compact('lapak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penduduks = Resident::latest()->get();
        return view('admin.content.village_stalls.create', compact('penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_penduduk' => 'required',
            'no_telepon' => 'required',
            'kategori' => 'nullable',
            'gambar_produk' => 'required|image',
            'deskripsi' => 'required',
        ]);

        $data['gambar_produk'] = $request->file('gambar_produk')->store('produk', 'public');

        VillageStall::create($data);

        return redirect()->route('lapak_desa.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $village_stall = VillageStall::with('resident')->findOrFail($id);
        return view('admin.content.village_stalls.show', compact('village_stall'));
    }

    // public function show(VillageStall $village_stall)
    // {
    //     return view('admin.content.village_stalls.show', compact('village_stall'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $village_stall = VillageStall::findOrFail($id);
        $penduduks = Resident::latest()->get();
        return view('admin.content.village_stalls.edit', compact('village_stall', 'penduduks'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, VillageStall $village_stall)
    {
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_penduduk' => 'required',
            'no_telepon' => 'required',
            'kategori' => 'nullable',
            'gambar_produk' => 'nullable|image',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('gambar_produk')) {
            $data['gambar_produk'] = $request->file('gambar_produk')->store('produk', 'public');
        }

        $village_stall->update($data);

        return redirect()->route('lapak_desa.index')->with('success', 'Produk berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $village_stall = VillageStall::findOrFail($id);
        $village_stall->delete();

        return redirect()->route('lapak_desa.index')->with('success', 'Produk berhasil dihapus!');
    }

    // public function destroy(VillageStall $village_stall)
    // {
    //     $village_stall->delete();
    //     return redirect()->route('lapak_desa.index')->with('success', 'Produk berhasil dihapus!');
    // }
}
