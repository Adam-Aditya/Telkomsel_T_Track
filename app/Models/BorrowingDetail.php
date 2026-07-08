<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowingDetail extends Model
{
    // Daftarkan kolom rincian transaksi
    protected $fillable = [
        'borrowing_id',
        'product_id',
        'qty',
    ];

    /**
     * Relasi balik ke data induk peminjaman
     */
    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    /**
     * Relasi ke data produk fisik
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}