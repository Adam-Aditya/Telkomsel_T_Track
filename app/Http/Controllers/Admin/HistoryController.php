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
        $statusFilter = $request->get('status');

        // Tarik data seluruh riwayat sirkulasi beserta detail barang dan user
        $history = Borrowing::with(['user', 'details.product'])
            ->when($search, function($query) use ($search) {
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })
            ->when($statusFilter, function($query) use ($statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->latest()
            ->paginate(15); // Menampilkan 15 riwayat per halaman

        return view('admin.history.index', compact('history'));
    }
}