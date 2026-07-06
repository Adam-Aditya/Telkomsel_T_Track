<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    // Mendaftarkan kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'product_code',
        'name',
        'category_id',
        'stock',
        'storage_location',
        'condition',
        'image',
    ];

    /**
     * Relasi balik ke tabel Kategori (Setiap produk memiliki satu kategori)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}