<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    protected $table = 'hamlets';
    protected $fillable = ['nama_dusun'];

    public function rws()
    {
        return $this->hasMany(Rw::class, 'id_dusun');
    }
}
