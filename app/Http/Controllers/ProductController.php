<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        // Parameter Baru untuk Sort/Urutkan
        $sortBy = $request->query('sort_by', 'created_at'); // Kolom default untuk sort
        $sortOrder = $request->query('sort_order', 'desc'); // Urutan default (asc/desc)
        // 1. Ambil semua parameter filter dari Request
        $category_id = $request->query('category_id');
        $searchQuery = $request->query('search');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        // Ambil semua kategori untuk navigasi/select option
        $categories = CategoryProduct::all();

        // 2. Mulai Query Builder dengan Eager Loading
        $productsQuery = Product::with('category');

        // --- 3. LOGIKA FILTER KONDISIONAL ---

        // A. Filter Berdasarkan Kategori
        if ($category_id) {
            $productsQuery->where('category_product_id', $category_id);
        }

        // B. Filter Berdasarkan Nama Produk (Search)
        if ($searchQuery) {
            $productsQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
        }

        // C. Filter Berdasarkan Rentang Harga
        if ($minPrice) {
            // WHERE price >= minPrice
            $productsQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            // WHERE price <= maxPrice
            $productsQuery->where('price', '<=', $maxPrice);
        }

        // --- 4. LOGIKA SORTING/URUTKAN ---
        $allowedSorts = ['name', 'price', 'created_at'];
        $allowedOrders = ['asc', 'desc'];

        // Validasi dan set default jika tidak valid
        $sortBy = in_array($sortBy, $allowedSorts) ? $sortBy : 'created_at';
        $sortOrder = in_array($sortOrder, $allowedOrders) ? $sortOrder : 'desc';

        // Terapkan sorting ke Query Builder
        $productsQuery->orderBy($sortBy, $sortOrder);

        // 4. Eksekusi Query dan Ambil Hasil
        $products = $productsQuery->get();

        // 5. Kirim data ke View
        return view('pages.products', compact(
            'products',
            'categories',
            'searchQuery',
            'category_id',
            'minPrice',
            'maxPrice',
            'sortBy',
            'sortOrder'
        ));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        if ($product) {
            return view('pages.show', compact('product'));
        } else {
            return redirect()->route('products')->with('error', 'kesalahan');
        }
    }

    public function create(Request $request)
    {
        $categories = CategoryProduct::all();

        if ($request->isMethod('post')) {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_product_id' => $request->category_product_id
            ]);

            if ($product) {
                return redirect()->route('products')->with('success', 'produk berhasil ditambahkan');
            } else {
                return back()->withInput()->with('error', 'maaf error');
            }
        }

        return view('pages.form', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        $categories = CategoryProduct::all();
        $product = Product::findOrFail($id);

        if ($request->isMethod('post')) {
            if ($product) {
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_product_id = $request->category_product_id;

                $product->save();
            }
            return redirect()->route('products')->with('success', 'produk di update');
        }
        return view('pages.form', compact('product', 'categories'));
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->isMethod('post')) {
            if ($product) {
                $product->delete();
                return redirect()->route('products')->with('success', 'produk dihapus');
            }
        }

        return redirect()->back()->with('error', 'produk tidak ada');
    }
}
