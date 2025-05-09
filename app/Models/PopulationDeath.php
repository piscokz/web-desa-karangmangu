<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationDeath extends Model
{
    use HasFactory;

    protected $casts = [
        'tanggal_meninggal' => 'date', // penting: auto cast ke Carbon
    ];
    
    protected $fillable = ['penduduk_id', 'tanggal_meninggal', 'penyebab', 'keterangan'];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'penduduk_id');
    }
}