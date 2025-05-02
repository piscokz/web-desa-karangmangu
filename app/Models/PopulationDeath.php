<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopulationDeath extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kematian';

    protected $fillable = [
        'nik',
        'tanggal_kematian',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'nik', 'nik');
    }
}
