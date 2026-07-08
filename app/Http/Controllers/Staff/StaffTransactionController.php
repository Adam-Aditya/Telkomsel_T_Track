<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffTransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Mengambil seluruh data sirkulasi transaksi secara global (Sama Seperti Admin)
        $transactions = Borrowing::with(['user.role', 'details.product'])
            ->when($search, function($query) use ($search) {
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        // Ambil data pendukung formulir dropdown
        $products = Product::where('stock', '>', 0)->where('condition', 'Bagus')->get();
        $users = User::with('role')->get(); // 🟢 TAMBAHKAN INI: Mengambil semua user/staff pendukung dropdown form
        $currentUser = Auth::user();

        // 🟢 SUNTIKKAN 'users' KE DALAM COMPACT
        return view('staff.transactions.index', compact('transactions', 'products', 'currentUser', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // 🟢 TAMBAHKAN INI: Validasi ID Peminjam pilihan
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Validasi ketersediaan volume muatan stok gudang
        if ($product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Volume stok perangkat di gudang tidak mencukupi pengajuan pasang Anda!']);
        }

        DB::transaction(function () use ($request, $product) {
            // 1. Buat Header Transaksi Peminjaman (Ganti Auth::id() menjadi input user_id pilihan form)
            $borrowing = Borrowing::create([
                'user_id' => $request->user_id, // 🟢 UBAH INI: Dinamis mengikuti pilihan dropdown
                'borrow_date' => $request->borrow_date,
                'return_date' => $request->return_date,
                'status' => 'Dipinjam',
            ]);

            // 2. Buat Detail Transaksi Muatan
            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'product_id' => $request->product_id,
                'qty' => $request->quantity,
            ]);

            // 3. Potong Kuantitas Volume Stok Utama Barang di Gudang
            $product->decrement('stock', $request->quantity);
        });

        return redirect()->route('staff.transactions.index')->with('success', 'Transaksi sirkulasi peminjaman perangkat berhasil diproses!');
    }

    public function returnTransaction($id)
    {
        // 🟢 UBAH INI: Hilangkan filter 'where('user_id', Auth::id())' agar staff bisa memproses return milik siapa saja
        $borrowing = Borrowing::findOrFail($id);

        if ($borrowing->status === 'Dikembalikan') {
            return redirect()->back()->with('error', 'Transaksi ini sudah berstatus selesai audit sirkulasi.');
        }

        DB::transaction(function () use ($borrowing) {
            // 1. Ubah Status Transaksi Menjadi Dikembalikan
            $borrowing->update(['status' => 'Dikembalikan']);

            // 2. Kembalikan Volume Kuantitas Stok Barang ke Gudang Utama
            $details = BorrowingDetail::where('borrowing_id', $borrowing->id)->get();
            foreach ($details as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->increment('stock', $detail->qty);
                }
            }
        });

        return redirect()->route('staff.transactions.index')->with('success', 'Aset logistik berhasil dikembalikan ke gudang internal!');
    }
}