<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    // Tambahkan fungsi ini di dalam class CouponController
    public function create()
    {
        // Menampilkan view form yang berada di folder resources/views/admin/coupons/form.blade.php
        return view('admin.coupons.form');
    }

    //
    public function store(Request $request)
    {
        // Validasi input admin
        $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons'],
            'type' => ['required', Rule::in(['fixed', 'percent'])],
            'value' => ['required', 'numeric', 'min:0'],
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupons.index')->withSuccess('Kupon berhasil dibuat');
    }

    public function destroy(\App\Models\Coupon $coupon)
    {
        // Menghapus data dari database
        $coupon->delete();

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.coupons.index')->withSuccess('Kupon berhasil dihapus!');
    }
}
