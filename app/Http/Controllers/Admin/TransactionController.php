<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil transaksi aktif yang belum selesai atau butuh konfirmasi
        $search = $request->get('search');

        $transactions = Borrowing::with(['user', 'details.product'])
            ->when($search, function($query) use ($search) {
                return $query->where('borrower_name', 'LIKE', "%{$search}%")
                             ->orWhere('id', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }
}
