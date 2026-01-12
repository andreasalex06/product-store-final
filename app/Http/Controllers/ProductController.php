<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk ke publik
     */
    public function index(Request $request)
    {
        $sortBy     = $request->query('sort_by', 'created_at');
        $sortOrder  = $request->query('sort_order', 'desc');
        $category_id = $request->query('category_id');
        $search     = $request->query('search');

        // CAST ke numeric agar aman
        $minPrice = $request->filled('min_price')
            ? (float) $request->query('min_price')
            : null;

        $maxPrice = $request->filled('max_price')
            ? (float) $request->query('max_price')
            : null;

        $categories = CategoryProduct::orderBy('name')->get();

        $productsQuery = Product::query()->with('category');

        /* ===============================
     | FILTER
     =============================== */

        if ($category_id) {
            $productsQuery->where('category_product_id', $category_id);
        }

        if ($search) {
            $productsQuery->where('name', 'LIKE', "%{$search}%");
        }

        // ✅ FILTER HARGA (VERSI BENAR)
        if (!is_null($minPrice) && !is_null($maxPrice)) {
            // swap jika user salah input
            if ($minPrice > $maxPrice) {
                [$minPrice, $maxPrice] = [$maxPrice, $minPrice];
            }

            $productsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif (!is_null($minPrice)) {
            $productsQuery->where('price', '>=', $minPrice);
        } elseif (!is_null($maxPrice)) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        /* ===============================
     | SORTING (SAFE LIST)
     =============================== */
        $allowedSorts  = ['name', 'price', 'created_at'];
        $allowedOrders = ['asc', 'desc'];

        $sortBy    = in_array($sortBy, $allowedSorts) ? $sortBy : 'created_at';
        $sortOrder = in_array($sortOrder, $allowedOrders) ? $sortOrder : 'desc';

        $products = $productsQuery
            ->orderBy($sortBy, $sortOrder)
            ->paginate(8)
            ->withQueryString();

        return view('pages.products', compact(
            'products',
            'categories',
            'search',
            'category_id',
            'minPrice',
            'maxPrice',
            'sortBy',
            'sortOrder'
        ));
    }


    public function show(Product $product)
    {
        $product = Product::with('reviews.user')->findOrFail($product->id);
        return view('pages.show', compact('product'));
    }
}
