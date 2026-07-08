<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. KARTU STATISTIK INDIVIDU STAFF
        // Total aset yang saat ini sedang dibawa/dipinjam oleh staff yang sedang login
        $myBorrowedAset = BorrowingDetail::whereHas('borrowing', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('status', 'Dipinjam');
        })->sum('qty');

        // Total transaksi pinjam milik staff ini yang sudah berstatus 'Dikembalikan'
        $myReturnedCount = Borrowing::where('user_id', $userId)->where('status', 'Dikembalikan')->count();

        // Total komoditas barang siap distribusi yang tersedia di gudang utama
        $totalAsetReady = Product::where('condition', 'Bagus')->sum('stock');


        // 2. DATA GRAFIK LINE CHART (Aktivitas Peminjaman Staff Sendiri per Bulan di Tahun Berjalan)
        $currentYear = date('Y');
        $monthlyData = array_fill(0, 12, 0);

        $myBorrowingsMonthly = BorrowingDetail::whereHas('borrowing', function ($query) use ($userId, $currentYear) {
                $query->where('user_id', $userId)->whereYear('borrow_date', $currentYear);
            })
            ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
            ->select(
                DB::raw('MONTH(borrowings.borrow_date) as month'),
                DB::raw('SUM(borrowing_details.qty) as total_qty')
            )
            ->groupBy(DB::raw('MONTH(borrowings.borrow_date)'))
            ->get();

        foreach ($myBorrowingsMonthly as $data) {
            $monthlyData[$data->month - 1] = (int) $data->total_qty;
        }


        // 3. KATEGORI YANG PALING SERING DIPINJAM OLEH STAFF INI
        $myCategories = Category::select('categories.name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('borrowing_details', 'products.id', '=', 'borrowing_details.product_id')
            ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
            ->where('borrowings.user_id', $userId)
            ->select('categories.name', DB::raw('SUM(borrowing_details.qty) as total_borrowed'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_borrowed', 'DESC')
            ->take(3)
            ->get();

        $grandTotalMyBorrowed = $myCategories->sum('total_borrowed') ?: 1;

        foreach ($myCategories as $cat) {
            $cat->percentage = round(($cat->total_borrowed / $grandTotalMyBorrowed) * 100);
        }


        // 4. LOG AKTIVITAS PINJAM TERAKHIR MILIK STAFF INI
        $myRecentLogs = Borrowing::with(['details.product'])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();


        return view('staff.dashboard', compact(
            'myBorrowedAset', 
            'myReturnedCount', 
            'totalAsetReady', 
            'monthlyData',
            'myCategories',
            'myRecentLogs'
        ));
    }
}