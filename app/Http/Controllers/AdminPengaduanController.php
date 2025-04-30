<?php

namespace App\Http\Controllers;

use App\Mail\ReplyPengaduanMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminPengaduanController extends Controller
{
    // 1. Tampilkan daftar pengaduan
    public function index()
    {
        $list = Contact::latest()->get();
        return view('admin.pengaduan.index', compact('list'));
    }

    // 2. Form balas
    public function showReplyForm(Contact $pengaduan)
    {
        return view('admin.pengaduan.answer', compact('pengaduan'));
    }

    // 3. Kirim balasan & hapus
    public function sendReply(Request $request, Contact $pengaduan)
    {
        $data = $request->validate([
            'subject' => 'required|string|min:3',
            'message' => 'required|string|min:5',
        ]);

        // Kirim email ke pelapor
        Mail::send(new ReplyPengaduanMail(
            $pengaduan,
            $data['subject'],
            $data['message']
        ));

        // Hapus data setelah dibalas
        $pengaduan->delete();

        return redirect()
            ->route('admin.pengaduan.index')
            ->with('success', 'Balasan terkirim, pengaduan telah dihapus.');
    }

    // 4. Hapus tanpa balas
    public function destroy(Contact $pengaduan)
    {
        $pengaduan->delete();
        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}