<?php

namespace App\Http\Controllers;

use App\Models\PopulationDeath;
use App\Models\Resident;
use Illuminate\Http\Request;

class PopulationDeathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deaths = PopulationDeath::with('resident')->latest()->get();
        return view('admin.content.populationDeath.index', compact('deaths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $residents = Resident::latest()->get();
        return view('admin.content.populationDeath.create', compact('residents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'tanggal_meninggal' => 'required|date',
            'penyebab' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        PopulationDeath::create($request->all());
        return redirect()->route('kematian.store')->with('success', 'Data kematian penduduk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $death = PopulationDeath::with('resident')->findOrFail($id);
        return view('admin.content.populationDeath.show', compact('death'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PopulationDeath $populationDeath, $penduduk_id)
    {
        $populationDeath = PopulationDeath::with('resident')->findOrFail($penduduk_id);
        $residents = Resident::latest()->get();
        return view('admin.content.populationDeath.edit', compact('populationDeath', 'residents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PopulationDeath $populationDeath)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:residents,id',
            'tanggal_meninggal' => 'required|date',
            'penyebab' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $populationDeath->update($request->all());
        return redirect()->route('kematian.index')->with('success', 'Data kematian penduduk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PopulationDeath $populationDeath, $penduduk_id)
    {
        $populationDeath = PopulationDeath::findOrFail($penduduk_id);
        $populationDeath->delete();
        return redirect()->route('kematian.index')->with('success', 'Data kematian penduduk berhasil dihapus!');
    }
}
