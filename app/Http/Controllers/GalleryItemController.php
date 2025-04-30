<?php
// app/Http/Controllers/Admin/GalleryItemController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryItemController extends Controller
{
    public function index()
    {
        $items = GalleryItem::latest()->paginate(12);
        return view('admin.content.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'date'     => 'required|date',
            'image'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        GalleryItem::create($data);
        return redirect()->route('admin.gallery.index')->with('success','Item berhasil ditambahkan.');
    }

    public function show(GalleryItem $gallery)
    {
        return view('admin.content.gallery.show', ['item' => $gallery]);
    }
    public function Frontindex()
    {
        $items = GalleryItem::latest()->get(); // Ambil semua item galeri
        return view('galeri', compact('items')); // Kirim ke view
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.content.gallery.edit', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'date'     => 'required|date',
            'image'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success','Item berhasil diperbarui.');
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success','Item berhasil dihapus.');
    }
}