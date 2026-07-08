<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        
        // Load relasi role untuk memastikan nama role terbaca dari DB
        $user = \App\Models\User::with('role')->find(Auth::id());
        
        if ($user->role && $user->role->name === 'Admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role && $user->role->name === 'Staff') {
            return redirect()->route('staff.dashboard');
        }

        // 🟢 GANTI BARIS YANG EROR MENJADI FALLBACK STRING AMAN INI:
        return redirect()->intended('/'); 
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
