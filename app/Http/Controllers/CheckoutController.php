<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // --- 1. TAMPILAN CHECKOUT (DARI KERANJANG) ---
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Keranjang kamu kosong.');
        }

        $items = $cart->items;
        $total = $cart->total();

        return view('checkout.index', compact('items', 'total'));
    }

    // --- 2. TAMPILAN CHECKOUT (BELI LANGSUNG) ---
    public function checkoutNow(Product $product)
    {
        session()->forget('_old_input');
        // Cek stok
        if ($product->stock < 1) {
            return back()->with('error', 'Stok habis!');
        }

        // Buat data "pura-pura" agar strukturnya sama dengan keranjang
        $items = collect([
            (object) [
                'product_id' => $product->id,
                'product' => $product,
                'quantity' => 1,
                'price' => $product->price,
                'subtotal' => $product->price
            ]
        ]);

        $total = $product->price;

        return view('checkout.index', compact('items', 'total', 'product'));
    }

    // --- 3. PROSES SIMPAN ORDER ---
    public function process(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'address' => 'required|min:5',
            'phone'   => 'required|min:8',
            'payment_method' => 'required',
            'items'   => 'required|array',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $subtotal = 0;
        $orderItems = [];

        // 2. Kalkulasi Ulang Berdasarkan Input Kuantitas
        foreach ($request->items as $productId => $data) {
            $product = Product::findOrFail($productId);
            $qty = $data['quantity'];

            if ($product->stock < $qty) {
                return back()->withInput()->with('error', "Stok {$product->name} tidak cukup.");
            }

            $subtotal += $product->price * $qty;

            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $qty,
                'price_at_purchase' => $product->price
            ];
        }

        // 3. Potong Diskon
        $discount = session('coupon')['discount'] ?? 0;
        $total_akhir = max(0, $subtotal - $discount);

        // 4. Buat Order
        $order = Order::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'phone'   => $request->phone,
            'payment_method' => $request->payment_method,
            'total' => $total_akhir,
            'status' => 'pending'
        ]);

        // 5. Simpan Detail Item & Kurangi Stok
        foreach ($orderItems as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
            Product::find($item['product_id'])->decrement('stock', $item['quantity']);
        }

        // Mengambil poin dari model Setting menggunakan helper yang kita buat tadi
        $pointsEarned = (int) Setting::get('points_per_checkout', 0);

        if ($pointsEarned > 0) {
            $user->increment('points', $pointsEarned);
        }

        // 6. Cleanup
        if (!$request->has('direct_product_id')) {
            $user->cart->items()->delete();
        }
        session()->forget(['coupon', 'coupon_code']);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }
    // Method untuk Pasang Kupon
    public function applyCoupon(Request $request)
    {

        if (session()->has('coupon')) {
            return back()->withInput()->with('error', 'Anda sudah menggunakan kupon. Hapus kupon lama untuk mengganti.');
        }

        $request->validate([
            'coupon_code' => ['required', 'string', 'exists:coupons,code'],
            'items' => ['required', 'array'], // Menangkap data qty dari form
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        // Hitung total berdasarkan kuantitas yang sedang diinput user
        $total_saat_ini = 0;
        foreach ($request->items as $productId => $data) {
            $product = Product::find($productId);
            if ($product) {
                $total_saat_ini += $product->price * $data['quantity'];
            }
        }

        session([
            'coupon' => [
                'code' => $coupon->code,
                'discount' => $this->calculateDiscount($coupon, $total_saat_ini),
                'last_total' => $total_saat_ini
            ]
        ]);

        // PENTING: withInput() mengembalikan data qty ke fungsi old() di Blade
        return back()->withInput()->withSuccess('Kupon berhasil diterapkan!');
    }

    // Method untuk Hapus Kupon
    public function removeCoupon(Request $request)
    {
        // Hapus data kupon dari session
        session()->forget(['coupon', 'coupon_code']);

        // Kembalikan input agar kuantitas, alamat, dll tidak reset
        return back()->withInput()->withSuccess('Kupon berhasil dihapus!');
    }

    // Tambahkan fungsi ini di dalam class controller yang sama
    private function calculateDiscount($coupon, $total_awal)
    {
        if ($coupon->type == 'percent') {
            // Logika potongan berdasarkan persentase
            return ($coupon->value / 100) * $total_awal;
        } else {
            // Logika potongan harga tetap (fixed)
            return $coupon->value;
        }
    }
}
