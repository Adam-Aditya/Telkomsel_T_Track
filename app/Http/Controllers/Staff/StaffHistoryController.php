<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class StaffHistoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        // Mengambil log data riwayat sirkulasi logistik secara global / personal sesuai kebutuhan
        $history = Borrowing::with(['user.role', 'details.product'])
            ->when($search, function($query) use ($search) {
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })
            ->when($status, function($query) use ($status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('staff.history.index', compact('history'));
    }
}