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
    $organisasi = $request->input('organisasi');

    $penduduk = Resident::with('familyCard')
        ->when($search, function ($query, $search) {
            $query->where('nik', 'like', "%{$search}%")
                ->orWhere('nama_lengkap', 'like', "%{$search}%")
                ->orWhereHas('familyCard', fn($q) => $q->where('no_kk', 'like', "%{$search}%"));
        })
        ->when($organisasi, function ($query, $organisasi) {
            $query->where('organisasi', $organisasi);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.content.resident.index', compact('penduduk', 'search', 'organisasi'));
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
        $rules = [
            'nik'                      => 'required|digits:16|unique:residents,nik',
            'nama_lengkap'             => 'required|string|max:255',
            'tempat_lahir'             => 'required|string|max:255',
            'tanggal_lahir'            => 'required|date',
            'jenis_kelamin'            => 'required|string|max:50',
            'jenis_kelamin_other'      => 'required_if:jenis_kelamin,Lainnya|string|max:50',
            'agama'                    => 'required|string|max:50',
            'agama_other'              => 'required_if:agama,Lainnya|string|max:50',
            'status_perkawinan'        => 'required|string|max:50',
            'status_perkawinan_other'  => 'required_if:status_perkawinan,Lainnya|string|max:50',
            'pekerjaan'                => 'nullable|string|max:100',
            'pendidikan'               => 'nullable|string|max:100',
            'nama_ayah'                => 'nullable|string|max:100',
            'nama_ibu'                 => 'nullable|string|max:100',
            'disabilitas'              => 'nullable|string|max:100',
            'organisasi'               => 'nullable|string|max:100',
            'foto'                     => 'nullable|image|max:2048',
            'gol_darah'                => 'nullable|string|max:5',
            'gol_darah_other'          => 'required_if:gol_darah,Lainnya|string|max:5',
            'shdk'                     => 'required|string|max:50',
            'shdk_other'               => 'required_if:shdk,Lainnya|string|max:50',
            'id_kk'                    => 'required|exists:family_cards,id',
            'no_telp'                  => 'nullable|string|max:20',
        ];

        $messages = [
            'nik.required'                     => 'NIK wajib diisi.',
            'nik.digits'                       => 'NIK harus terdiri dari 16 digit.',
            'nik.unique'                       => 'NIK sudah terdaftar.',
            'nama_lengkap.required'            => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max'                 => 'Nama lengkap maksimal 255 karakter.',
            'tempat_lahir.required'            => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max'                 => 'Tempat lahir maksimal 255 karakter.',
            'tanggal_lahir.required'           => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'               => 'Tanggal lahir tidak valid.',
            'jenis_kelamin.required'           => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.max'                => 'Jenis kelamin maksimal 50 karakter.',
            'jenis_kelamin_other.required_if'  => 'Mohon isi jenis kelamin jika memilih "Lainnya".',
            'agama.required'                   => 'Agama wajib dipilih.',
            'agama.max'                        => 'Agama maksimal 50 karakter.',
            'agama_other.required_if'          => 'Mohon isi agama jika memilih "Lainnya".',
            'status_perkawinan.required'       => 'Status perkawinan wajib dipilih.',
            'status_perkawinan.max'            => 'Status perkawinan maksimal 50 karakter.',
            'status_perkawinan_other.required_if' => 'Mohon isi status perkawinan jika memilih "Lainnya".',
            'pekerjaan.max'                    => 'Pekerjaan maksimal 100 karakter.',
            'pendidikan.max'                   => 'Pendidikan maksimal 100 karakter.',
            'nama_ayah.max'                    => 'Nama ayah maksimal 100 karakter.',
            'nama_ibu.max'                     => 'Nama ibu maksimal 100 karakter.',
            'disabilitas.max'                  => 'Disabilitas maksimal 100 karakter.',
            'organisasi.max'                   => 'Organisasi maksimal 100 karakter.',
            'foto.image'                       => 'Foto harus berupa gambar.',
            'foto.max'                         => 'Foto maksimal 2 MB.',
            'gol_darah.max'                    => 'Golongan darah maksimal 5 karakter.',
            'gol_darah_other.required_if'      => 'Mohon isi golongan darah jika memilih "Lainnya".',
            'shdk.required'                    => 'SHDK wajib dipilih.',
            'shdk.max'                         => 'SHDK maksimal 50 karakter.',
            'shdk_other.required_if'           => 'Mohon isi SHDK jika memilih "Lainnya".',
            'id_kk.required'                   => 'Kartu Keluarga wajib dipilih.',
            'id_kk.exists'                     => 'Kartu Keluarga tidak ditemukan.',
            'no_telp.max'                      => 'No. telepon maksimal 20 karakter.',
        ];

        $data = $request->validate($rules, $messages);

        // Handle opsi "Lainnya"
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nik'                      => 'required|digits:16|unique:residents,nik,' . $id,
            'nik.unique'               => 'NIK sudah terdaftar.',
            'nama_lengkap'             => 'required|string|max:255',
            'tempat_lahir'             => 'required|string|max:255',
            'tanggal_lahir'            => 'required|date',
            'jenis_kelamin'            => 'required|string|max:50',
            'jenis_kelamin_other'      => 'required_if:jenis_kelamin,Lainnya|string|max:50',
            'agama'                    => 'required|string|max:50',
            'agama_other'              => 'required_if:agama,Lainnya|string|max:50',
            'status_perkawinan'        => 'required|string|max:50',
            'status_perkawinan_other'  => 'required_if:status_perkawinan,Lainnya|string|max:50',
            'pekerjaan'                => 'nullable|string|max:100',
            'pendidikan'               => 'nullable|string|max:100',
            'nama_ayah'                => 'nullable|string|max:100',
            'nama_ibu'                 => 'nullable|string|max:100',
            'disabilitas'              => 'nullable|string|max:100',
            'organisasi'               => 'nullable|string|max:100',
            'foto'                     => 'nullable|image|max:2048',
            'gol_darah'                => 'nullable|string',
            'gol_darah_other'          => 'required_if:gol_darah,Lainnya|string',
            'shdk'                     => 'required|string|max:50',
            'shdk_other'               => 'required_if:shdk,Lainnya|string|max:50',
            'id_kk'                    => 'required|exists:family_cards,id',
            'no_telp'                  => 'nullable|string|max:20',
        ];

        // reuse same pesan validasi
        $messages = $messages = [
            'nik.required'                     => 'NIK wajib diisi.',
            'nik.unique'                       => 'NIK sudah terdaftar.',
            'nik.digits'                       => 'NIK harus terdiri dari 16 digit.',
            'nama_lengkap.required'            => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max'                 => 'Nama lengkap maksimal 255 karakter.',
            'tempat_lahir.required'            => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max'                 => 'Tempat lahir maksimal 255 karakter.',
            'tanggal_lahir.required'           => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'               => 'Tanggal lahir tidak valid.',
            'jenis_kelamin.required'           => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.max'                => 'Jenis kelamin maksimal 50 karakter.',
            'jenis_kelamin_other.required_if'  => 'Mohon isi jenis kelamin jika memilih "Lainnya".',
            'agama.required'                   => 'Agama wajib dipilih.',
            'agama.max'                        => 'Agama maksimal 50 karakter.',
            'agama_other.required_if'          => 'Mohon isi agama jika memilih "Lainnya".',
            'status_perkawinan.required'       => 'Status perkawinan wajib dipilih.',
            'status_perkawinan.max'            => 'Status perkawinan maksimal 50 karakter.',
            'status_perkawinan_other.required_if' => 'Mohon isi status perkawinan jika memilih "Lainnya".',
            'pekerjaan.max'                    => 'Pekerjaan maksimal 100 karakter.',
            'pendidikan.max'                   => 'Pendidikan maksimal 100 karakter.',
            'nama_ayah.max'                    => 'Nama ayah maksimal 100 karakter.',
            'nama_ibu.max'                     => 'Nama ibu maksimal 100 karakter.',
            'disabilitas.max'                  => 'Disabilitas maksimal 100 karakter.',
            'organisasi.max'                   => 'Organisasi maksimal 100 karakter.',
            'foto.image'                       => 'Foto harus berupa gambar.',
            'foto.max'                         => 'Foto maksimal 2 MB.',
            // 'gol_darah.max'                    => 'Golongan darah maksimal 5 karakter.',
            // 'gol_darah_other.required_if'      => 'Mohon isi golongan darah jika memilih "Lainnya".',
            'shdk.required'                    => 'SHDK wajib dipilih.',
            'shdk.max'                         => 'SHDK maksimal 50 karakter.',
            'shdk_other.required_if'           => 'Mohon isi SHDK jika memilih "Lainnya".',
            'id_kk.required'                   => 'Kartu Keluarga wajib dipilih.',
            'id_kk.exists'                     => 'Kartu Keluarga tidak ditemukan.',
            'no_telp.max'                      => 'No. telepon maksimal 20 karakter.',
        ];

        $data = $request->validate($rules, $messages);

        // Handle opsi "Lainnya"
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