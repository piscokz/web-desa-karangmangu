<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    protected $table = 'rts';
    // protected $primaryKey = 'id_rt';
    protected $fillable = ['nomor_rt', 'id_rw'];

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_rw');
    }
}
