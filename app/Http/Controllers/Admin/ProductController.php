<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = Category::all();
        
        // --- LOGIKA OTOMATISASI KODE BARANG ---
        // Ambil produk terakhir yang didaftarkan
        $lastProduct = Product::latest('id')->first();

        if (!$lastProduct) {
            $nextNumber = 1;
        } else {
            // Menggunakan regex untuk membuang semua teks non-angka KECUALI angka urut di belakang
            // Ini menjamin tanda minus (-) tidak ikut terbaca sebagai bilangan negatif
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastProduct->product_code);
            $nextNumber = $lastNumber + 1;
        }

        // Menghasilkan string TS-0001, TS-0002, dst secara akurat
        $autoProductCode = 'TS-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        // --------------------------------------

        $products = Product::with('category')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('product_code', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // Kirim variabel $autoProductCode ke view
        return view('admin.products.index', compact('products', 'categories', 'autoProductCode'));
    }
    public function store(Request $request)
    {
        // Validasi input form sesuai aturan database
        $validated = $request->validate([
            'product_code' => 'required|string|unique:products,product_code|max:50',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'storage_location' => 'required|string|max:100',
            'condition' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // Handle bonus fitur: Upload Gambar Barang jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Simpan ke database
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Aset baru berhasil didaftarkan ke sistem!');
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi data input edit
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'storage_location' => 'required|string|max:100',
            'condition' => 'required|in:Bagus,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika ada upload gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Update data ke database
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Data aset berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar dari storage jika ada agar tidak memenuhi memori server
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        // Hapus data dari database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Aset logistik berhasil dihapus permanen dari sistem!');
    }
}
