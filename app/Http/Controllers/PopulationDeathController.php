<?php

namespace App\Http\Controllers;

use App\Models\PopulationDeath;
use App\Models\Resident;
use Illuminate\Http\Request;

class PopulationDeathController extends Controller
{
    public function index()
    {
        $deaths = PopulationDeath::with('resident')
                    ->latest('tanggal_meninggal')
                    ->get();

        return view('admin.content.populationDeath.index', compact('deaths'));
    }

    public function create()
    {
        // ambil hanya penduduk yang belum memiliki record kematian
        $residents = Resident::doesntHave('death')
                        ->orderBy('nama_lengkap')
                        ->get();

        return view('admin.content.populationDeath.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'penduduk_id'       => 'required|exists:residents,id',
            'tanggal_meninggal' => 'required|date',
            'penyebab'          => 'nullable|string|max:255',
            'keterangan'        => 'nullable|string',
        ]);

        PopulationDeath::create($data);

        return redirect()
            ->route('kematian.index')
            ->with('success', 'Data kematian penduduk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        // definisikan ulang agar blade menerima variabel yang jelas
        $death     = PopulationDeath::findOrFail($id);
        // penduduk yang belum mati, plus penduduk saat ini (supaya tetap muncul di select)
        $residents = Resident::where(function($q) use ($death) {
                            $q->doesntHave('death')
                              ->orWhere('id', $death->penduduk_id);
                        })
                        ->orderBy('nama_lengkap')
                        ->get();

        return view('admin.content.populationDeath.edit', compact('death', 'residents'));
    }

    public function update(Request $request, string $id)
    {
        $populationDeath = PopulationDeath::findOrFail($id);
        $data = $request->validate([
            'penduduk_id'       => 'required|exists:residents,id',
            'tanggal_meninggal' => 'required|date',
            'penyebab'          => 'nullable|string|max:255',
            'keterangan'        => 'nullable|string',
        ]);

        $populationDeath->update($data);

        return redirect()
            ->route('kematian.index')
            ->with('success', 'Data kematian penduduk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $populationDeath = PopulationDeath::findOrFail($id);
        $populationDeath->delete();
        return redirect()
            ->route('kematian.index')
            ->with('success', 'Data kematian penduduk berhasil dihapus!');
    }
}