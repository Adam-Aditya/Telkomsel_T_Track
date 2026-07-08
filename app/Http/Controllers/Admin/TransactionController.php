<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Ambil data produk yang stoknya > 0 untuk opsi form transaksi baru
        $products = Product::where('stock', '>', 0)->get();

        // Ambil data semua user (Staff/Manager) untuk dropdown pilihan peminjam di Form
        $users = User::all();

        // Tarik data transaksi beserta relasi user pembawa/peminjam aset
        $transactions = Borrowing::with(['user'])
            ->when($search, function($query) use ($search) {
                // Pencarian berdasarkan nama user yang meminjam
                return $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions', 'products', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input transaksi baru sesuai skema
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validasi user yang meminjam
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cek ketersediaan stok barang fisik di gudang
        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok barang tidak mencukupi untuk kuantitas pinjam ini!']);
        }

        // 1. Simpan ke database sesuai kolom tabel borrowings Anda
        $borrowing = Borrowing::create([
            'user_id' => $request->user_id, // Menyimpan ID User yang meminjam aset
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'Dipinjam', // Default enum status sesuai skema Anda
        ]);

        // 2. Simpan rincian item ke tabel borrowing_details
        $borrowing->details()->create([
            'product_id' => $request->product_id,
            'qty' => $request->quantity,
        ]);

        // 3. Potong jumlah stok produk di gudang secara otomatis
        $product->decrement('stock', $request->quantity);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi peminjaman aset berhasil diproses!');
    }

    public function returnAsset($id)
    {
        $borrowing = Borrowing::with('details')->findOrFail($id);
        
        if ($borrowing->status === 'Dipinjam') {
            // Kembalikan jumlah stok barang ke gudang semula
            foreach ($borrowing->details as $detail) {
                Product::where('id', $detail->product_id)->increment('stock', $detail->qty);
            }
            
            // Ubah status sirkulasi menjadi 'Dikembalikan' sesuai enum database Anda
            $borrowing->update(['status' => 'Dikembalikan']);
        }

        return redirect()->route('admin.transactions.index')->with('success', 'Aset logistik telah berhasil dikembalikan ke gudang!');
    }
}