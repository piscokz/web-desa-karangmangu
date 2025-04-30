<?php

namespace App\Http\Controllers;

use App\Models\FamilyCard;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource with search and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $penduduk = Resident::with('familyCard')
            ->when($search, function ($query, $search) {
                $query->where('nik', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhereHas('familyCard', fn($q) => $q->where('no_kk', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.content.resident.index', compact('penduduk', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kks = FamilyCard::all();
        return view('admin.content.resident.create', compact('kks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:residents,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:50',
            'jenis_kelamin_other' => 'required_if:jenis_kelamin,Lainnya|string|max:50',
            'agama' => 'required|string|max:50',
            'agama_other' => 'required_if:agama,Lainnya|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'status_perkawinan_other' => 'required_if:status_perkawinan,Lainnya|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            // 'gol_darah' => 'nullable|string|max:5',
            'gol_darah_other' => 'required_if:gol_darah,Lainnya|string|max:5',
            'shdk' => 'required|string|max:50',
            'shdk_other' => 'required_if:shdk,Lainnya|string|max:50',
            'id_kk' => 'required|exists:family_cards,id',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $data = $request->except([
            'jenis_kelamin_other',
            'agama_other',
            'status_perkawinan_other',
            'gol_darah_other',
            'shdk_other'
        ]);

        // Handle "Lainnya"
        if ($request->jenis_kelamin === 'Lainnya') {
            $data['jenis_kelamin'] = $request->jenis_kelamin_other;
        }
        if ($request->agama === 'Lainnya') {
            $data['agama'] = $request->agama_other;
        }
        if ($request->status_perkawinan === 'Lainnya') {
            $data['status_perkawinan'] = $request->status_perkawinan_other;
        }
        if ($request->gol_darah === 'Lainnya') {
            $data['gol_darah'] = $request->gol_darah_other;
        }
        if ($request->shdk === 'Lainnya') {
            $data['shdk'] = $request->shdk_other;
        }

        Resident::create($data);
        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = Resident::with('familyCard')->findOrFail($id);
        return view('admin.content.resident.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penduduk = Resident::findOrFail($id);
        $kks = FamilyCard::all();
        return view('admin.content.resident.edit', compact('penduduk', 'kks'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|digits:16|unique:residents,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:50',
            'jenis_kelamin_other' => 'required_if:jenis_kelamin,Lainnya|string|max:50',
            'agama' => 'required|string|max:50',
            'agama_other' => 'required_if:agama,Lainnya|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'status_perkawinan_other' => 'required_if:status_perkawinan,Lainnya|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            // 'gol_darah' => 'nullable|string|max:1',
            'gol_darah_other' => 'required_if:gol_darah,Lainnya|string|max:5',
            'shdk' => 'required|string|max:50',
            'shdk_other' => 'required_if:shdk,Lainnya|string|max:50',
            'id_kk' => 'required|exists:family_cards,id',
            'no_telp' => 'nullable|string|max:20',
        ]);

        $data = $request->except([
            'jenis_kelamin_other', 'agama_other',
            'status_perkawinan_other', 'gol_darah_other', 'shdk_other'
        ]);

        if ($request->jenis_kelamin === 'Lainnya') {
            $data['jenis_kelamin'] = $request->jenis_kelamin_other;
        }
        if ($request->agama === 'Lainnya') {
            $data['agama'] = $request->agama_other;
        }
        if ($request->status_perkawinan === 'Lainnya') {
            $data['status_perkawinan'] = $request->status_perkawinan_other;
        }
        if ($request->gol_darah === 'Lainnya') {
            $data['gol_darah'] = $request->gol_darah_other;
        }
        if ($request->shdk === 'Lainnya') {
            $data['shdk'] = $request->shdk_other;
        }

        Resident::findOrFail($id)->update($data);
        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Resident::findOrFail($id)->delete();
        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil dihapus!');
    }
}