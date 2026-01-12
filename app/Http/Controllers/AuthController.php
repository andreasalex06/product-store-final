<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login-form');
    }

    public function showRegisterForm()
    {
        return view('auth.register-form');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:4', 'confirmed']
        ]);

        $user = User::create($validated);

        return redirect()->route('login.form')->with('success', 'registrasi berhasil');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // dd($credentials, Auth::attempt($credentials));

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('home')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Anda berhasil logout.');
    }
}
