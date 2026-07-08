<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Borrowing;
use App\Models\Product;

class DashboardManagerController extends Controller
{
    public function index(Request $request)
    {
        // ==========================================================
        // 📊 AMBIL DATA CARD STATISTIK UTAMA (SUMMARY CARDS)
        // ==========================================================
        $totalGlobalBorrowed = DB::table('borrowings')
            ->join('borrowing_details', 'borrowings.id', '=', 'borrowing_details.borrowing_id')
            ->where('borrowings.status', 'Dipinjam')
            ->sum('borrowing_details.qty') ?? 0;

        $totalAudited = Borrowing::where('status', 'Dikembalikan')->count();
        $totalAsetReady = Product::where('condition', 'Bagus')->sum('stock') ?? 0;


        // ==========================================================
        // 📜 [BARU] LOG AKTIVITAS TERBARU TIM STAFF (UNTUK TABEL BAWAH)
        // ==========================================================
        // Mengambil 5 transaksi sirkulasi logistik paling baru dari tim lapangan
        $teamRecentLogs = Borrowing::with(['user', 'details.product'])
            ->latest()
            ->take(5)
            ->get();


        // ==========================================================
        // 📈 DATA KATEGORI POPULER & LINE CHART
        // ==========================================================
        $categoriesPopular = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('borrowing_details', 'products.id', '=', 'borrowing_details.product_id')
            ->select('categories.name', DB::raw('COUNT(borrowing_details.id) as total'))
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $totalSirkulasi = $categoriesPopular->sum('total') ?: 1;
        foreach ($categoriesPopular as $cat) {
            $cat->percentage = round(($cat->total / $totalSirkulasi) * 100);
        }

        $monthlyBorrowings = Borrowing::select(
                DB::raw('MONTH(borrow_date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('borrow_date', 2026)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyData[] = $monthlyBorrowings[$m] ?? 0;
        }

        // ==========================================================
        // 🟢 SUNTIKKAN SEMUA VARIABEL KE VIEW WORKSPACE MANAGER
        // ==========================================================
        return view('manager.dashboard', compact(
            'totalGlobalBorrowed', 
            'totalAudited', 
            'totalAsetReady', 
            'teamRecentLogs', // <-- Variabel baru disuntikkan ke dalam compact
            'categoriesPopular', 
            'monthlyData'
        ));
    }
}