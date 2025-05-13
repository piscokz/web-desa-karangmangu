<?php

namespace App\Http\Controllers;

use App\Models\VillageMember;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VillageMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = VillageMember::latest()->get();
        return view('admin.content.village_member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.village_member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = new VillageMember($request->all());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $member->foto = $filename;
        }

        $member->save();

        return redirect()->route('anggota_desa.index')->with('success', 'Berhasil membuat data anggota desa.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = VillageMember::findOrFail($id);
        return view('admin.content.village_member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = VillageMember::findOrFail($id);
        return view('admin.content.village_member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = VillageMember::findOrFail($id);
        $member->fill($request->all());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $member->foto = $filename;
        }

        $member->save();

        return redirect()->route('village_members.index')->with('success', 'Berhasil perbarui data anggota desa.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = VillageMember::findOrFail($id);
        if ($member->foto) {
            unlink(public_path('images/' . $member->foto));
        }
        $member->delete();

        return redirect()->route('anggota_desa.index')->with('success', 'Berhasil hapus data anggota desa.');
    }
}
