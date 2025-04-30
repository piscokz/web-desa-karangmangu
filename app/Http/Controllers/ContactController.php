<?php

namespace App\Http\Controllers;

use App\Mail\NewPengaduanMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $req)
    {
        $data = $req->validate([
            'nama'      => 'required|string',
            'email'     => 'required|email',
            'rw'        => 'required|string',
            'rt'        => 'required|string',
            'waktu'     => 'required|date',
            'lokasi'    => 'required|string',
            'deskripsi' => 'required|string',
            'bukti'     => 'nullable|array|max:5',
            'bukti.*'   => 'image|max:2048',
        ]);

        try {
            // Simpan file bukti jika ada
            if ($req->hasFile('bukti')) {
                $paths = [];
                foreach ($req->file('bukti') as $f) {
                    $paths[] = $f->store('pengaduan', 'public');
                }
                $data['bukti'] = $paths;
            }

            // Simpan ke database
            $contact = Contact::create($data);

            // Kirim email notifikasi ke admin
            Mail::send(new NewPengaduanMail($contact));

            return redirect()->back()->with('success', 'Pengaduan Anda berhasil dikirim.');

        } catch (\Exception $e) {
            Log::error('Gagal mengirim pengaduan: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Maaf, pengaduan gagal dikirim. Silakan coba lagi.');
        }
    }
}