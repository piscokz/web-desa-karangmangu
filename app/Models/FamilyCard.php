<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    protected $table = 'family_cards';
    protected $fillable = ['no_kk', 'alamat', 'id_rt', 'id_rw', 'id_dusun'];

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_rt');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_rw');
    }

    public function hamlet()
    {
        return $this->belongsTo(Hamlet::class, 'id_dusun');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class, 'id_kk');
    }
}
