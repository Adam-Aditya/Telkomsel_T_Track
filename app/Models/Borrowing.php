<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrowing extends Model
{
    // Daftarkan kolom yang diizinkan untuk diisi massal
    protected $fillable = [
        'user_id',
        'borrower_name',
        'borrow_date',
        'return_date',
        'status',
    ];

    /**
     * Relasi ke User/Staff pembuka otorisasi transaksi
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Tabel Rincian Item Peminjaman
     */
    public function details(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}