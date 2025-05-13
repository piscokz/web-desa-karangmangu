<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Resident extends Model
{
    protected $table = 'residents';
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'gol_darah',
        'shdk',
        'id_kk',
        'no_telp',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'disabilitas',
        'organisasi',
        'foto',
        'kematian',
        // 'nik_ayah', 'nik_ibu'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function familyCard()
    {
        return $this->belongsTo(FamilyCard::class, 'id_kk');
    }

    // App\Models\Resident.php
    public function populationDeath()
    {
        return $this->hasOne(PopulationDeath::class, 'penduduk_id');
    }

    public function death()
    {
        return $this->hasOne(PopulationDeath::class, 'penduduk_id');
    }

    public function stalls()
    {
        return $this->hasMany(VillageStall::class, 'id_penduduk', 'id');
    }

    // Scope untuk filter organisasi
    public function scopeFilterByOrganisasi(Builder $query, $organisasi)
    {
        return $query->where('organisasi', 'like', '%' . $organisasi . '%');
    }
}