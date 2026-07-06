<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    // Relasi: Satu role bisa dimiliki oleh banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
