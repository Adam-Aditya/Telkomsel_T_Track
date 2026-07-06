<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\HistoryController;

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
    
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');

    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// 4. Placeholder Proteksi Halaman Staff & Manager (Guna persiapan langkah berikutnya)
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', function () { return "Dashboard Staff - Dalam Pengembangan"; })->name('staff.dashboard');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager/dashboard', function () { return "Dashboard Manager - Dalam Pengembangan"; })->name('manager.dashboard');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () { return view('admin'); })->name('admin.dashboard');
    
    // Rute Master Data Logistik Baru
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () { return view('admin'); })->name('admin.dashboard');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    
    // Rute Halaman Transaksi Baru
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () { return view('admin'); })->name('admin.dashboard');
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
    
    // Rute Halaman Riwayat Baru
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
});

require __DIR__.'/auth.php';