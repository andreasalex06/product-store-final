<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\LoyaltyReward;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    // Tampilan Dashboard Admin untuk Loyalty & Settings
    public function index()
    {
        $pointsConfig = Setting::where('key', 'points_per_checkout')->first();
        $rewards = LoyaltyReward::latest()->get();

        return view('admin.loyalty.index', compact('pointsConfig', 'rewards'));
    }

    // Update Poin Global (yang dipanggil di CheckoutController)
    public function updatePoints(Request $request)
    {
        $request->validate([
            'points_value' => 'required|integer|min:0'
        ]);

        Setting::updateOrCreate(
            ['key' => 'points_per_checkout'],
            [
                'value' => $request->points_value,
                'display_name' => 'Poin per Checkout'
            ]
        );

        return back()->with('success', 'Pengaturan poin berhasil diperbarui!');
    }

    // Tambah Voucher Hadiah Baru
    public function storeReward(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'points_required' => 'required|integer', // Sesuaikan dengan database
            'discount_amount' => 'required|numeric',
            'coupon_code' => 'required|unique:loyalty_rewards,coupon_code'
        ]);

        LoyaltyReward::create($validated);

        return back()->with('success', 'Berhasil menambahkan reward!');
    }

    // Hapus Voucher Hadiah
    public function destroyReward(LoyaltyReward $reward)
    {
        $reward->delete();
        return back()->with('success', 'Voucher berhasil dihapus.');
    }
}
