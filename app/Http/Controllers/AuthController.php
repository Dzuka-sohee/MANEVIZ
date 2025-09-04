<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showSignInForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if user is active
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->back()
                    ->with('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
            }

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Selamat datang, Admin ' . $user->name . '!');
            }

            return redirect()->intended('/')
                ->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput();
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout.');
    }
}
