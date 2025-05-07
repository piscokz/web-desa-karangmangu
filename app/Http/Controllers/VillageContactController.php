<?php

namespace App\Http\Controllers;

use App\Models\VillageContact;
use Illuminate\Http\Request;

class VillageContactController extends Controller
{
    public function edit() {
        $kontak = VillageContact::findOrFail(1);
        return view('admin.content.village_contact.edit', compact('kontak'));
    }

    public function update(Request $request) {
        $request->validate([
            'no_telepon' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
        ]);
        
        $villageContact = VillageContact::findOrFail(1);
        $villageContact->update($request->all());
        return redirect()->route('kontak.edit')->with('success', 'Data kontak desa berhasil diperbarui.');

    }
}
