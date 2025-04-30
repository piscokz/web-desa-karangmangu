<?php
// app/Models/GalleryItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'date',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];
    
    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/'.$this->image)
            : 'https://via.placeholder.com/800x600?text=No+Image';
    }
}