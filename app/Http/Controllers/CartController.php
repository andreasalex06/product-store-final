<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        $cart = Auth::user()->cart()->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
            ]);
        }

        return view('cart.index', compact('cart'));
    }

    // Menambahkan produk ke keranjang
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Ambil cart user, atau buat baru kalau belum ada
        $cart = Auth::user()->cart()->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
            ]);
        }

        // cek apakah product sudah ada di keranjang
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
                'price_at_purchase' => $product->price,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }


    // Update jumlah item
    public function update(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item->quantity = $request->quantity;
        $item->save();

        return back()->with('success', 'Jumlah produk diperbarui.');
    }


    // Hapus item dari cart
    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
