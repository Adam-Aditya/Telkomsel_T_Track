<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerStaffController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Query penarikan akun ber-role Staff DAN Admin beserta akumulasi sirkulasinya
        $staffMembers = User::with(['role', 'borrowings' => function($query) {
                $query->latest()->take(1); 
            }])
            ->whereHas('role', function($q) {
                // 🟢 UBAH INI: Menggunakan whereIn agar role 'Staff' dan 'Admin' ikut tersaring
                $q->whereIn('name', ['Staff', 'Admin']);
            })
            ->withCount(['borrowings as total_transactions'])
            ->withSum(['borrowings as total_items_handled' => function($query) {
                $query->join('borrowing_details', 'borrowings.id', '=', 'borrowing_details.borrowing_id');
            }], 'borrowing_details.qty')
            ->when($search, function($query) use ($search) {
                return $query->where(function($element) use ($search) {
                    $element->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        // 🟢 UBAH INI: Hitung total gabungan personil Admin + Staff untuk ringkasan atas
        $totalActiveStaff = User::whereHas('role', function($q) { 
            $q->whereIn('name', ['Staff', 'Admin']); 
        })->count();
        
        $totalGlobalSirkulasi = DB::table('borrowings')->count();

        return view('manager.staff.index', compact('staffMembers', 'totalActiveStaff', 'totalGlobalSirkulasi'));
    }
}