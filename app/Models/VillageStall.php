<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageStall extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'id_penduduk',
        'no_telepon',
        'kategori',
        'gambar_produk',
        'deskripsi',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'id_penduduk', 'id');
    }
}
