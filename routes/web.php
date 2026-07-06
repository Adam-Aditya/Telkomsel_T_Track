<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Depan (Login / Register terintegrasi yang Anda buat)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// 2. Rute Filter Pusat setelah Login/Register Sukses
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Deteksi role_id dari database
    if ($user->role_id == 1) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role_id == 2) {
        return redirect()->route('staff.dashboard');
    } elseif ($user->role_id == 3) {
        return redirect()->route('manager.dashboard');
    }

    return abort(403, 'Peran akun tidak dikenali.');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Proteksi Halaman Khusus Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin'); // Memanggil file resources/views/admin.blade.php
    })->name('admin.dashboard');
    
    // Anda bisa meletakkan rute manajemen barang, sortir aset, dan kelola staff di sini nanti
});

// 4. Placeholder Proteksi Halaman Staff & Manager (Guna persiapan langkah berikutnya)
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', function () { return "Dashboard Staff - Dalam Pengembangan"; })->name('staff.dashboard');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager/dashboard', function () { return "Dashboard Manager - Dalam Pengembangan"; })->name('manager.dashboard');
});

require __DIR__.'/auth.php';