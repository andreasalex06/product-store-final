<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    // 1. TAMPILKAN SEMUA DISKUSI (PUBLIK)
    public function index()
    {
        // Ambil semua diskusi, urutkan dari yang terbaru
        // 'with' digunakan agar aplikasi tidak berat (Eager Loading)
        $discussions = Discussion::with(['user', 'admin'])->latest()->get();

        return view('discussions.index', compact('discussions'));
    }

    // 2. SIMPAN PERTANYAAN USER
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'subject' => 'required|max:255',
            'question' => 'required',
        ]);

        // Simpan ke database
        Discussion::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'subject' => $request->subject,
            'question' => $request->question,
        ]);

        return back()->with('success', 'Pertanyaan berhasil dikirim! Menunggu jawaban admin.');
    }

    // 3. SIMPAN JAWABAN ADMIN
    public function answer(Request $request, $id)
    {
        // Cek apakah user adalah Admin
        // Contoh sederhana: cek kolom is_admin di tabel users (jika ada)
        // Atau cek manual berdasarkan email tertentu
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda bukan Admin.');
        }

        $request->validate(['answer' => 'required']);

        // Cari diskusi berdasarkan ID
        $discussion = Discussion::findOrFail($id);

        // Update data
        $discussion->update([
            'answer' => $request->answer,
            'admin_id' => Auth::id(), // ID Admin yang menjawab
            'is_answered' => true,
        ]);

        return back()->with('success', 'Jawaban berhasil dikirim.');
    }
}
