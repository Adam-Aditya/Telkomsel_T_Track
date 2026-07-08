<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffAccountController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffProductController;
use App\Http\Controllers\Staff\StaffTransactionController;
use App\Http\Controllers\Staff\StaffHistoryController;
use App\Http\Controllers\Manager\DashboardManagerController;
use App\Http\Controllers\Manager\ManagerReportController;
use App\Http\Controllers\Manager\ManagerProductController;
use App\Http\Controllers\Manager\ManagerStaffController;

// ==========================================
// 1. Halaman Depan / Welcome
// ==========================================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// ==========================================
// 2. Rute Filter Pusat setelah Login/Register Sukses
// ==========================================
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

// ==========================================
// 3. Proteksi Halaman Khusus ADMIN (Hanya Ditulis 1 Grup Saja)
// ==========================================
Route::middleware(['auth', 'role:Admin'])->group(function () {
    
    // --- Dashboard Utama ---
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // --- Kelompok Master Data Logistik (Products CRUD) ---
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // --- Kelompok Sirkulasi Transaksi ---
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
    Route::post('/admin/transactions', [TransactionController::class, 'store'])->name('admin.transactions.store');
    Route::put('/admin/transactions/{id}/return', [TransactionController::class, 'returnAsset'])->name('admin.transactions.return');

    // --- Kelompok Manajemen Akun Akses ---
    Route::get('/admin/users', [StaffAccountController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users', [StaffAccountController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [StaffAccountController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [StaffAccountController::class, 'destroy'])->name('admin.users.destroy');

    // --- Kelompok Jurnal Riwayat & Audit ---
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('admin.history.index');
});

// ==========================================
// 4. Placeholder Proteksi Halaman Staff & Manager
// ==========================================
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');

    Route::get('/staff/products', [StaffProductController::class, 'index'])->name('staff.products.index');
    Route::post('/staff/products', [StaffProductController::class, 'store'])->name('staff.products.store');
    Route::put('/staff/products/{id}', [StaffProductController::class, 'update'])->name('staff.products.update');
    Route::delete('/staff/products/{id}', [StaffProductController::class, 'destroy'])->name('staff.products.destroy');

    Route::get('/staff/transactions', [StaffTransactionController::class, 'index'])->name('staff.transactions.index');
    Route::post('/staff/transactions', [StaffTransactionController::class, 'store'])->name('staff.transactions.store');
    Route::put('/staff/transactions/{id}/return', [StaffTransactionController::class, 'returnTransaction'])->name('staff.transactions.return');

    Route::get('/staff/history', [StaffHistoryController::class, 'index'])->name('staff.history.index');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager/dashboard', [DashboardManagerController::class, 'index'])->name('manager.dashboard');
    
    // Placeholder rute menu sidebar manager agar link aman dari error
    Route::get('/manager/reports', function() { return 'Halaman Laporan'; })->name('manager.reports.index');
    Route::get('/manager/products', function() { return 'Halaman Monitoring Stok'; })->name('manager.products.index');
    Route::get('/manager/staff', function() { return 'Halaman Aktivitas Tim Staff'; })->name('manager.staff.index');

    Route::get('/manager/reports', [ManagerReportController::class, 'index'])->name('manager.reports.index');
    
    Route::get('/manager/products', [ManagerProductController::class, 'index'])->name('manager.products.index');
    Route::get('/manager/staff', [ManagerStaffController::class, 'index'])->name('manager.staff.index');
});

// ==========================================
// 5. Autentikasi Bawaan Laravel Breeze / Jetstream
// ==========================================
require __DIR__.'/auth.php';