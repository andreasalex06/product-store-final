<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyReward;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    public function index()
    {
        // Ambil semua reward yang tersedia
        $rewards = LoyaltyReward::all();
        return view('loyalty.index', compact('rewards'));
    }

    public function redeem(LoyaltyReward $reward)
    {
        $user = Auth::user();

        // 1. Validasi Poin
        if ($user->points < $reward->points_required) {
            return back()->with('error', 'Poin Anda tidak mencukupi.');
        }

        // 2. Kurangi Poin User
        $user->decrement('points', $reward->points_required);

        // 3. Daftarkan ke tabel Coupons agar bisa dipakai saat Checkout
        Coupon::updateOrCreate(
            ['code' => $reward->coupon_code],
            [
                'type' => 'fixed',
                'value' => $reward->discount_amount,
            ]
        );

        return back()->with('success', "Berhasil tukar poin! Gunakan kode kupon: {$reward->coupon_code}");
    }
}
