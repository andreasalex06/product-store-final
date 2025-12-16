<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // LIST ORDER USER
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();

        return view('orders.index', compact('orders'));
    }

    // DETAIL ORDER
    public function show($id)
    {
        $order = Auth::user()->orders()
                    ->with('items.product')
                    ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
