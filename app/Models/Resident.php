<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';
    protected $fillable = [
        'nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
        'status_perkawinan', 'pekerjaan', 'pendidikan', 'gol_darah', 'shdk', 'id_kk',
        'no_telp', 'alamat', 
        // 'nik_ayah', 'nik_ibu'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date', 
    ];

    public function familyCard()
    {
        return $this->belongsTo(FamilyCard::class, 'id_kk');
    }

    // public function father()
    // {
    //     return $this->belongsTo(Resident::class, 'nik_ayah', 'nik');
    // }

    // public function mother()
    // {
    //     return $this->belongsTo(Resident::class, 'nik_ibu', 'nik');
    // }
}
