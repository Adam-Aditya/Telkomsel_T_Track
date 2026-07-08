<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KARTU STATISTIK GLOBAL LOGISTIK
        $totalAset = Product::sum('stock'); 

        // Total kuantitas barang yang saat ini sedang dipinjam
        $asetDipinjam = BorrowingDetail::whereHas('borrowing', function ($query) {
            $query->where('status', 'Dipinjam');
        })->sum('qty');

        // Total kuantitas barang yang tersedia di gudang (kondisi Bagus + Rusak Ringan)
        $asetTersedia = Product::whereIn('condition', ['Bagus', 'Rusak Ringan'])->sum('stock');

        // Total kuantitas barang dengan kondisi Rusak Berat (Karantina)
        $asetRusak = Product::where('condition', 'Rusak Berat')->sum('stock');


        // 2. DATA GRAFIK LINE CHART (Volume Peminjaman Per Bulan di Tahun Berjalan)
        $currentYear = date('Y');
        $monthlyData = array_fill(0, 12, 0);

        $borrowingsMonthly = BorrowingDetail::whereHas('borrowing', function ($query) use ($currentYear) {
                $query->whereYear('borrow_date', $currentYear);
            })
            ->join('borrowings', 'borrowing_details.borrowing_id', '=', 'borrowings.id')
            ->select(
                DB::raw('MONTH(borrowings.borrow_date) as month'),
                DB::raw('SUM(borrowing_details.qty) as total_qty')
            )
            ->groupBy(DB::raw('MONTH(borrowings.borrow_date)'))
            ->get();

        foreach ($borrowingsMonthly as $data) {
            $monthlyData[$data->month - 1] = (int) $data->total_qty;
        }


        // 3. KATEGORI LOGISTIK TERPOPULER
        $categoriesPopular = Category::select('categories.name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('borrowing_details', 'products.id', '=', 'borrowing_details.product_id')
            ->select('categories.name', DB::raw('SUM(borrowing_details.qty) as total_borrowed'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_borrowed', 'DESC')
            ->take(3)
            ->get();

        $grandTotalBorrowed = $categoriesPopular->sum('total_borrowed') ?: 1;

        foreach ($categoriesPopular as $cat) {
            $cat->percentage = round(($cat->total_borrowed / $grandTotalBorrowed) * 100);
        }

        return view('admin', compact(
            'totalAset', 
            'asetDipinjam', 
            'asetTersedia', 
            'asetRusak', 
            'monthlyData',
            'categoriesPopular'
        ));
    }
}