<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $condition = $request->get('condition');
        $categoryId = $request->get('category_id');

        // Query penarikan data produk dengan pencarian dan filter
        $products = Product::with('category')
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('product_code', 'LIKE', "%{$search}%");
                });
            })
            ->when($condition, function($query) use ($condition) {
                return $query->where('condition', $condition);
            })
            ->when($categoryId, function($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(10);

        // Ambil data pendukung filter dropdown
        $categories = Category::all();

        // Ringkasan Widget Statistik Atas
        $totalStockBagus = Product::where('condition', 'Bagus')->sum('stock') ?? 0;
        $totalItemsKritis = Product::where('condition', 'Bagus')->where('stock', '<=', 5)->count();

        return view('manager.products.index', compact('products', 'categories', 'totalStockBagus', 'totalItemsKritis'));
    }
}