<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageContact extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_contact'; // karena kamu pakai id custom
    protected $fillable = [
        'no_telepon',
        'email',
        'instagram',
        'youtube',
    ];
}
