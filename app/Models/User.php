<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // 🟢 TAMBAHKAN INI

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Berhasil diamankan untuk keperluan registrasi pilihan role
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 🟢 TAMBAHKAN INI: Relasi One-to-Many ke Model Borrowing
     * Menyatakan bahwa satu User/Staff bisa melakukan banyak transaksi sirkulasi.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class, 'user_id');
    }

    /**
     * Hubungan Relasi (Inverse Relation)
     * Menyatakan bahwa satu User terikat pada satu Role tertentu.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}