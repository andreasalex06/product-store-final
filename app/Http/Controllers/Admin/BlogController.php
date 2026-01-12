<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil diterbitkan!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return back()->with('success', 'Blog berhasil dihapus.');
    }

    public function edit(Blog $blog)
    {
        // Pastikan view ini nanti dibuat di langkah ke-2
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        // 1. Validasi
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Cek apakah ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        // 3. Update Data (Slug otomatis diupdate jika menggunakan mutator/observer, atau biarkan tetap)
        // Jika Anda ingin update slug sesuai title baru:
        // $validated['slug'] = \Str::slug($request->title);

        $blog->update($validated);

        // 4. Redirect
        return redirect()->route('admin.blogs.index')->with('success', 'Blog berhasil diperbarui!');
    }
}
