<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // TAMPILAN CHECKOUT
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    // PROSES CHECKOUT
    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|min:5',
            'phone'   => 'required|min:8',
            'payment_method' => 'required'
        ]);

        $cart = Auth::user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // 1. BUAT ORDER
        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'phone'   => $request->phone,
            'payment_method' => $request->payment_method,
            'total' => $cart->total()
        ]);

        // 2. PINDAHKAN ITEM CART → ORDER_ITEMS / invoice
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_purchase' => $item->product->price, // WAJIB DIISI
            ]);
        }

        // 3. KOSONGKAN KERANJANG
        CartItem::where('cart_id', $cart->id)->delete();

        return redirect()->route('orders.index')->with('success', 'Checkout berhasil!');
    }
}
