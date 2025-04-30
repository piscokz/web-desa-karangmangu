<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    ArticleController,
    GalleryItemController,
    ContactController,
    AdminPengaduanController,
    FamilyCardController,
    HamletController,
    ResidentController,
    RtController,
    RwController,
};

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/berita', [ArticleController::class, 'frontIndex'])
     ->name('news');

Route::get('/berita-detail/{id}', [ArticleController::class, 'showLove'])
     ->name('article.show');

     Route::get('/gallery', [GalleryItemController::class, 'frontIndex'])
     ->name('galeri');

Route::get('/peta-winduherang', function () {
    return view('peta');
})->name('peta');

Route::get('/wartaWargi-winduherang', function () {
    return view('wartawar');
})->name('wartaWargi');

Route::get('/pemerintahan-winduherang', function () {
    return view('pemerintahan');
})->name('pemerintahan');

Route::post('/pengaduan', [ContactController::class,'store'])->name('pengaduan.store');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/content/article', ArticleController::class)->names('admin.article');
    Route::resource('admin/content/gallery', GalleryItemController::class)->names('admin.gallery');

    Route::resource('admin/content/penduduk', ResidentController::class)->names('penduduk');
    Route::resource('admin/content/kk', FamilyCardController::class)->names('kk');
    Route::resource('admin/content/dusun', HamletController::class)->names('dusun');
    Route::resource('admin/content/rw', RwController::class)->names('rw');
    Route::resource('admin/content/rt', RtController::class)->names('rt');


    Route::get('/dashboard', function () {
        return view('admin.content.dashboard');
    })->name('admin.dashboard');

    Route::get('admin/pengaduan', [AdminPengaduanController::class, 'index'])
        ->name('admin.pengaduan.index');

    Route::get('admin/pengaduan/{pengaduan}/reply', [AdminPengaduanController::class, 'showReplyForm'])
        ->name('admin.pengaduan.reply');

    Route::post('admin/pengaduan/{pengaduan}/reply', [AdminPengaduanController::class, 'sendReply'])
        ->name('admin.pengaduan.sendReply');

    Route::delete('admin/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'destroy'])
        ->name('admin.pengaduan.destroy');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
