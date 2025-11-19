<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    // Try admin login first
    if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    // Try regular user login
    if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        // Check if a redirect URL was provided (from booking form)
        $redirectUrl = $request->input('redirect', '/');

        return redirect()->intended($redirectUrl);
    }

    // Failed login
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
