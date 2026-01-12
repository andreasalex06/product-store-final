<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        $partners = Partner::all();
        return view('pages.home', compact('settings', 'partners'));
    }
}
