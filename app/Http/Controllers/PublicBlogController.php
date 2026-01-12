<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
    // Menampilkan daftar semua blog
    public function index()
    {
        $blogs = Blog::latest()->paginate(9); // Menggunakan pagination agar rapi
        return view('blogs.index', compact('blogs'));
    }

    // Menampilkan isi detail blog berdasarkan slug
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }
}
