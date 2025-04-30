<?php

namespace App\Http\Controllers;

use App\Models\FamilyCard;
use App\Models\Hamlet;
use Illuminate\Http\Request;

class FamilyCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kartuKeluarga = FamilyCard::with(['hamlet', 'rw', 'rt'])
            ->when($search, function ($query, $search) {
                $query->where('no_kk', 'like', "%{$search}%")
                      ->orWhereHas('hamlet', fn($q) => $q->where('nama_dusun', 'like', "%{$search}%"))
                      ->orWhereHas('rw', fn($q) => $q->where('nomor_rw', 'like', "%{$search}%"))
                      ->orWhereHas('rt', fn($q) => $q->where('nomor_rt', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.content.familyCard.index', compact('kartuKeluarga', 'search'));  
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dusuns = Hamlet::with('rws.rts')->get();  // Ambil semua data dusun
        return view('admin.content.familyCard.create', compact('dusuns'));  // Tampilkan form input
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'no_kk' => 'required|unique:family_cards,no_kk|digits:16',  // No KK wajib unik dan panjang 16 digit
            // 'alamat' => 'required|string|max:500',                            // Alamat wajib diisi dan maksimal 500 karakter
            'id_rt' => 'required|exists:rts,id',                   // ID RT wajib ada dan valid
            'id_rw' => 'required|exists:rws,id',                      // ID RW wajib ada dan valid
            'id_dusun' => 'required|exists:hamlets,id',                         // ID Dusun wajib ada dan valid
        ]);

        // Simpan data kartu keluarga ke database
        FamilyCard::create($request->all());

        // Redirect ke halaman daftar kartu keluarga dengan pesan sukses
        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kartuKeluarga = FamilyCard::with(['residents', 'hamlet', 'rw', 'rt'])->findOrFail($id);  // Ambil data kartu keluarga berdasarkan ID
        return view('admin.content.familyCard.show', compact('kartuKeluarga'));  // Kirim data ke view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kartuKeluarga = FamilyCard::with(['hamlet', 'rw', 'rt'])->findOrFail($id);  // Ambil data kartu keluarga berdasarkan ID
        $dusuns = Hamlet::with('rws.rts')->get();  // Ambil semua data dusun
        return view('admin.content.familyCard.edit', compact('kartuKeluarga', 'dusuns'));  // Kirim data ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inputan
        $request->validate([
            'no_kk' => 'required|digits:16|unique:family_cards,no_kk,' . $id,  // No KK wajib unik kecuali untuk yang sedang diupdate
            // 'alamat' => 'required|string|max:500',                                     // Alamat wajib diisi dan maksimal 500 karakter
            'id_rt' => 'required|exists:rts,id',                            // ID RT wajib ada dan valid
            'id_rw' => 'required|exists:rws,id',                               // ID RW wajib ada dan valid
            'id_dusun' => 'required|exists:hamlets,id',                                  // ID Dusun wajib ada dan valid
        ]);

        // Cari kartu keluarga berdasarkan ID dan update data
        $kartuKeluarga = FamilyCard::findOrFail($id);
        $kartuKeluarga->update($request->all());

        // Redirect ke halaman daftar kartu keluarga dengan pesan sukses
        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari kartu keluarga berdasarkan ID dan hapus
        $kartuKeluarga = FamilyCard::findOrFail($id);
        $kartuKeluarga->delete();

        // Redirect ke halaman daftar kartu keluarga dengan pesan sukses
        return redirect()->route('kk.index')->with('success', 'Kartu Keluarga berhasil dihapus!');
    }
}
