<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = Category::all();
        
        // --- LOGIKA OTOMATISASI KODE BARANG (SINKRON DENGAN ADMIN) ---
        $lastProduct = Product::latest('id')->first();

        if (!$lastProduct) {
            $nextNumber = 1;
        } else {
            // Menggunakan regex untuk mengambil angka urut di belakang kode aset
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastProduct->product_code);
            $nextNumber = $lastNumber + 1;
        }

        $autoProductCode = 'TS-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        // -------------------------------------------------------------

        $products = Product::with('category')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('product_code', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // Kirim variabel ke view staff
        return view('staff.products.index', compact('products', 'categories', 'autoProductCode'));
    }

    public function store(Request $request)
    {
        // Validasi input form disamakan persis dengan standardisasi Admin
        $validated = $request->validate([
            'product_code' => 'required|string|unique:products,product_code|max:50',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'storage_location' => 'required|string|max:100',
            'condition' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // Handle fitur upload Gambar Barang dari Staff
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Simpan ke database
        Product::create($validated);

        return redirect()->route('staff.products.index')->with('success', 'Aset baru berhasil didaftarkan oleh Staff ke sistem!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi data input edit disamakan dengan Admin
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'storage_location' => 'required|string|max:100',
            'condition' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika Staff mengupload gambar baru, hapus gambar lama dari storage server
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Update data ke database
        $product->update($validated);

        return redirect()->route('staff.products.index')->with('success', 'Data aset berhasil diperbarui oleh Staff!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar dari storage disk public agar tidak merusak pathing Admin
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus data dari database
        $product->delete();

        return redirect()->route('staff.products.index')->with('success', 'Aset logistik berhasil dihapus permanen dari sistem!');
    }
}