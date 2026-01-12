<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:1000',
        ]);

        ProductReview::create([
            'product_id' => $request->product_id,
            'user_id'    => auth()->id(), // Mengambil ID user yang login
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->withSuccess('Review berhasil dikirim!');
    }
}
