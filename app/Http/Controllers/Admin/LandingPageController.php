<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua setting teks
        $settings = SiteSetting::pluck('value', 'key');
        // Ambil semua partner
        $partners = Partner::latest()->get();

        return view('admin.landing.index', compact('settings', 'partners'));
    }

    public function updateSettings(Request $request)
    {
        // Loop semua input kecuali token dan file
        foreach ($request->except('_token', 'partner_logo', 'partner_name') as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Konten halaman berhasil diperbarui!');
    }

    public function storePartner(Request $request)
    {
        $request->validate([
            'partner_name' => 'required',
            'partner_logo' => 'required|image|max:2048'
        ]);

        $path = $request->file('partner_logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->partner_name,
            'image' => $path
        ]);

        return back()->with('success', 'Logo partner berhasil ditambahkan!');
    }

    public function destroyPartner($id)
    {
        $partner = Partner::findOrFail($id);
        Storage::disk('public')->delete($partner->image);
        $partner->delete();

        return back()->with('success', 'Partner dihapus!');
    }
}
