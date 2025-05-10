<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageMember extends Model
{
    protected $table = 'village_members';

    protected $fillable = [
        'nama',
        'jabatan',
        'jenis_kelamin',
        'umur',
        'alamat',
        'foto',
    ];
}
