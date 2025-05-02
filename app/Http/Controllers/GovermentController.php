<?php

namespace App\Http\Controllers;

use App\Models\Goverment;
use Illuminate\Http\Request;

class GovermentController extends Controller
{
    public function index()
    {
        // tampilkan semua perangkat desa
        $goverments = Goverment::all();
        return view('goverment.index', compact('goverments'));
    }

    public function create()
    {
        return view('goverment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no' => 'required|integer',
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer',
            'alamat' => 'required|string',
            'foto' => 'nullable|string',
            'kategori' => 'required|string',
        ]);

        Goverment::create($validated);
        return redirect()->route('goverment.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(Goverment $goverment)
    {
        return view('goverment.show', compact('goverment'));
    }

    public function edit(Goverment $goverment)
    {
        return view('goverment.edit', compact('goverment'));
    }

    public function update(Request $request, Goverment $goverment)
    {
        $validated = $request->validate([
            'no' => 'required|integer',
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer',
            'alamat' => 'required|string',
            'foto' => 'nullable|string',
            'kategori' => 'required|string',
        ]);

        $goverment->update($validated);
        return redirect()->route('goverment.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Goverment $goverment)
    {
        $goverment->delete();
        return redirect()->route('goverment.index')->with('success', 'Data berhasil dihapus!');
    }
}
