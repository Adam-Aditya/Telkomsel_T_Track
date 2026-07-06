<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Mengambil riwayat sirkulasi yang sudah 'Selesai' (dikembalikan)
        $history = Borrowing::with(['user', 'details.product'])
            ->where('status', 'Selesai')
            ->when($search, function($query) use ($search) {
                return $query->where('borrower_name', 'LIKE', "%{$search}%")
                             ->orWhere('id', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.history.index', compact('history'));
    }
}
