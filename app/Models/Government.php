<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goverment extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama',
        'jabatan',
        'jenis_kelamin',
        'umur',
        'alamat',
        'foto',
        'kategori',
    ];
}
