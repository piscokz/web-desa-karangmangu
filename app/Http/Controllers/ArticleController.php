<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Tampilkan daftar artikel dengan pencarian, filter, dan pagination
    public function index(Request $request)
    {
        $query = Article::query();

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(10)->appends($request->query());

        // Ambil kategori unik dari database
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('admin.content.article.index', compact('articles', 'categories'));
    }

    // Form tambah artikel baru
    public function create()
    {
        return view('admin.content.article.create');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'category' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'author_photo' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal harus :min karakter.',
            'content.required' => 'Konten wajib diisi.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'image.image' => 'File gambar tidak valid.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'author_photo.image' => 'Foto penulis harus berupa gambar.',
            'author_photo.max' => 'Ukuran foto penulis maksimal 2MB.',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }
        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $request->file('author_photo')->store('authors', 'public');
        }

        Article::create($data);

        return redirect('/admin/content/article')->with('success', 'Artikel berhasil ditambahkan.');
    }

    // Tampilkan artikel spesifik
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.content.article.show', compact('article'));
    }

    // Form edit artikel
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.content.article.edit', compact('article'));
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'category' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'author_name' => 'nullable|string',
            'author_photo' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal harus :min karakter.',
            'content.required' => 'Konten wajib diisi.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Tanggal tidak valid.',
            'image.image' => 'File gambar tidak valid.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'author_photo.image' => 'Foto penulis harus berupa gambar.',
            'author_photo.max' => 'Ukuran foto penulis maksimal 2MB.',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }
        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $request->file('author_photo')->store('authors', 'public');
        }

        $article->update($data);

        return redirect('/admin/content/article')->with('success', 'Artikel berhasil diperbarui.');
    }

    // app/Http/Controllers/ArticleController.php

    public function frontIndex(Request $request)
    {
        $query = Article::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(9)->appends($request->query());
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('berita', compact('articles', 'categories'));
    }

    // Tampilkan artikel spesifik
    public function showLove($id)
    {
        $article = Article::findOrFail($id);
        return view('berita-detail', compact('article'));
    }

    // Hapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect('/admin/content/article')->with('success', 'Artikel berhasil dihapus.');
    }

}