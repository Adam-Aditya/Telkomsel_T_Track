<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');

        // Query penarikan master data distribusi sirkulasi
        $reports = Borrowing::with(['user.role', 'details.product.category'])
            ->when($startDate, function($query) use ($startDate) {
                return $query->whereDate('borrow_date', '>=', $startDate);
            })
            ->when($endDate, function($query) use ($endDate) {
                return $query->whereDate('borrow_date', '<=', $endDate);
            })
            ->when($status, function($query) use ($status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(15); // Laporan eksekutif memuat baris data lebih panjang (15 baris)

        // Ringkasan Akumulasi Total Muatan Kuantitas Khusus Periode Terpilih (Summary Widgets)
        $totalItemsDistributed = DB::table('borrowings')
            ->join('borrowing_details', 'borrowings.id', '=', 'borrowing_details.borrowing_id')
            ->when($startDate, function($q) use ($startDate) { return $q->whereDate('borrow_date', '>=', $startDate); })
            ->when($endDate, function($q) use ($endDate) { return $q->whereDate('borrow_date', '<=', $endDate); })
            ->when($status, function($q) use ($status) { return $q->where('borrowings.status', $status); })
            ->sum('borrowing_details.qty') ?? 0;

        return view('manager.reports.index', compact('reports', 'totalItemsDistributed'));
    }
}