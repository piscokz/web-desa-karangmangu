<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    protected $table = 'rws';
    protected $fillable = ['nomor_rw', 'id_dusun'];

    public function hamlet()
    {
        return $this->belongsTo(Hamlet::class, 'id_dusun');
    }

    public function rts()
    {
        return $this->hasMany(Rt::class, 'id_rw');
    }
}
