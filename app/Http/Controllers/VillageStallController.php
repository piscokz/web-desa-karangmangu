<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\VillageStall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VillageStallController extends Controller
{
    public function index()
    {
        $lapak = VillageStall::with('resident')->get();
        return view('admin.content.village_stalls.index', compact('lapak'));
    }

    public function create()
    {
        $penduduks = Resident::latest()->get();
        return view('admin.content.village_stalls.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_produk.required'   => 'Nama produk wajib diisi.',
            'id_penduduk.required'   => 'Anda harus memilih pemilik produk.',
            'no_telepon.required'    => 'Nomor telepon wajib diisi.',
            'gambar_produk.required' => 'Gambar produk wajib diunggah.',
            'gambar_produk.image'    => 'File yang diunggah harus berupa gambar.',
            'deskripsi.required'     => 'Deskripsi produk wajib diisi.',
            'harga_produk.required'     => 'Harga produk wajib diisi.',
        ];

        $data = $request->validate([
            'nama_produk'   => 'required',
            'id_penduduk'   => 'required',
            'no_telepon'    => 'required',
            'harga_produk'    => 'required',
            'kategori'      => 'nullable',
            'gambar_produk' => 'required|image',
            'deskripsi'     => 'required',
        ], $messages);

        $data['gambar_produk'] = $request
            ->file('gambar_produk')
            ->store('produk', 'public');

        VillageStall::create($data);

        return redirect()
            ->route('lapak_desa.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(VillageStall $lapak_desa)
    {
        // $lapak_desa is the bound model
        return view('admin.content.village_stalls.show', [
            'village_stall' => $lapak_desa->load('resident'),
        ]);
    }

    public function edit(VillageStall $lapak_desa)
    {
        $penduduks = Resident::latest()->get();
        return view('admin.content.village_stalls.edit', [
            'village_stall' => $lapak_desa,
            'penduduks'     => $penduduks,
        ]);
    }

    public function update(Request $request, VillageStall $lapak_desa)
    {
        $messages = [
            'nama_produk.required'   => 'Nama produk wajib diisi.',
            'id_penduduk.required'   => 'Anda harus memilih pemilik produk.',
            'no_telepon.required'    => 'Nomor telepon wajib diisi.',
            'gambar_produk.image'    => 'File yang diunggah harus berupa gambar.',
            'deskripsi.required'     => 'Deskripsi produk wajib diisi.',
            'harga_produk.required'     => 'Harga produk wajib diisi.',
        ];

        $data = $request->validate([
            'nama_produk'   => 'required',
            'id_penduduk'   => 'required',
            'no_telepon'    => 'required',
            'kategori'      => 'nullable',
            'harga_produk'      => 'required',
            'gambar_produk' => 'nullable|image',
            'deskripsi'     => 'required',
        ], $messages);

        if ($request->hasFile('gambar_produk')) {
            // optionally delete old
            Storage::disk('public')->delete($lapak_desa->gambar_produk);
            $data['gambar_produk'] = $request
                ->file('gambar_produk')
                ->store('produk', 'public');
        }

        $lapak_desa->update($data);

        return redirect()
            ->route('lapak_desa.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(VillageStall $lapak_desa)
    {
        // optionally delete image
        Storage::disk('public')->delete($lapak_desa->gambar_produk);
        $lapak_desa->delete();

        return redirect()
            ->route('lapak_desa.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function FrontIndex(Request $request)
    {
        // Ambil 12 per halaman
        $stalls = VillageStall::with('resident')
                              ->paginate(12);

        // Unique categories untuk filter
        $categories = $stalls->pluck('kategori')
                             ->filter()
                             ->unique()
                             ->values();

        return view('umkm', compact('stalls', 'categories'));
    }
}