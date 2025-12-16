<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Parameter
        $sortBy = $request->query('sort_by', 'created_at');
        $sortOrder = $request->query('sort_order', 'desc');
        $category_id = $request->query('category_id');
        $searchQuery = $request->query('search');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        // Ambil semua kategori untuk navigasi/select option (urut rapi)
        $categories = CategoryProduct::orderBy('name')->get();

        // Query builder dengan eager loading
        $productsQuery = Product::with('category');

        // Conditional filters (gunakan checks yang aman agar 0 tidak terabaikan)
        if ($category_id !== null && $category_id !== '') {
            $productsQuery->where('category_product_id', $category_id);
        }

        if ($searchQuery !== null && $searchQuery !== '') {
            $productsQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
        }

        if ($minPrice !== null && $minPrice !== '') {
            $productsQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice !== null && $maxPrice !== '') {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        // Sorting safe-list
        $allowedSorts = ['name', 'price', 'created_at'];
        $allowedOrders = ['asc', 'desc'];
        $sortBy = in_array($sortBy, $allowedSorts) ? $sortBy : 'created_at';
        $sortOrder = in_array($sortOrder, $allowedOrders) ? $sortOrder : 'desc';

        $productsQuery->orderBy($sortBy, $sortOrder);

        // Eksekusi query — gunakan paginate untuk production
        $products = $productsQuery->paginate(8)->withQueryString(); // ->paginate(20)->withQueryString();

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
        return view('pages.show', compact('product'));
    }

    public function create(Request $request)
    {
        $categories = CategoryProduct::orderBy('name')->get();

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:2000'],
                'price' => ['required', 'numeric', 'min:0'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'category_product_id' => ['required', 'integer', Rule::exists('category_products', 'id')],
            ]);

            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('products_image', $image, $imageName);

            $newRequest = $request->all();
            $newRequest['image'] = $imageName;

            $product = Product::create($newRequest);

            if ($product) {
                return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan');
            }

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan produk');
        }

        return view('pages.form', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        $categories = CategoryProduct::orderBy('name')->get();
        $product = Product::findOrFail($id);

        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:2000'],
                'price' => ['required', 'numeric', 'min:0'],
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'category_product_id' => ['required', 'integer', Rule::exists('category_products', 'id')],
            ]);

            // default gunakan nilai lama
            $imageName = $product->image;

            // jika ada upload baru: simpan file baru lalu hapus file lama
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $newImageName = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                // simpan path lengkap di storage/public/products_image/...
                Storage::disk('public')->putFileAs('products_image', $image, $newImageName);

                // hapus file lama bila ada (cek dua kemungkinan penyimpanan)
                if ($product->image) {
                    $possible = [$product->image, 'products_image/' . $product->image];
                    foreach ($possible as $p) {
                        if ($p && Storage::disk('public')->exists($p)) {
                            Storage::disk('public')->delete($p);
                            break;
                        }
                    }
                }

                // simpan nama/path yang baru ke payload
                $imageName = $newImageName; // atau $path jika ingin menyimpan 'products_image/xxx.jpg'
                // rekomendasi: simpan $path so Storage::url() langsung cocok:
                $validated['image'] = $imageName;
            }

            // jika tidak upload, biarkan image tetap seperti sebelumnya
            if (!isset($validated['image'])) {
                // pastikan nilai image lama tetap terset sesuai kolom DB
                $validated['image'] = $product->image;
            }

            // gunakan validated (aman) dan update pada instance
            $product->update($validated);

            return redirect()->route('products')->with('success', 'Produk berhasil diperbarui');
        }

        return view('pages.form', compact('product', 'categories'));
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);


        if ($request->isMethod('post') || $request->isMethod('delete')) {

            if ($product->image && Storage::disk('public')->exists('products_image/' . $product->image)) {
                Storage::disk('public')->delete('products_image/' . $product->image);
            }

            $product->delete();
            return redirect()->route('products')->with('success', 'Produk dihapus');
        }

        return redirect()->back()->with('error', 'Produk tidak ada');
    }
}
