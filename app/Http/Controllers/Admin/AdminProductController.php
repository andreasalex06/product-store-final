<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = CategoryProduct::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|max:2048',
            'category_product_id' => 'required|exists:category_products,id',
        ]);

        $imageName = Str::uuid() . '.' . $request->image->extension();
        $request->image->storeAs('products_image', $imageName, 'public');

        $validated['image'] = $imageName;
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }


    public function edit(Product $product)
    {
        $categories = CategoryProduct::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'category_product_id' => 'required|exists:category_products,id',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists('products_image/' . $product->image)) {
                Storage::disk('public')->delete('products_image/' . $product->image);
            }
 
            $imageName = Str::uuid() . '.' . $request->image->extension();
            $request->image->storeAs('products_image', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists('products_image/' . $product->image)) {
            Storage::disk('public')->delete('products_image/' . $product->image);
        }

        $product->delete();

        return back()->with('success', 'Produk dihapus');
    }


    /**
     * Form edit stok
     */
    public function editStock(Product $product)
    {
        return view('admin.products.edit-stock', compact('product'));
    }

    /**
     * Update stok
     */
    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $product->update([
            'stock' => $validated['stock'],
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Stok berhasil diperbarui');
    }
}
