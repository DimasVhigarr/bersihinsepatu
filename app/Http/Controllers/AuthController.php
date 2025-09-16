<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AuthController extends Controller
{
  public function showLoginForm()
    {
        return view('auth.login'); // Diubah dari user.login
    }

    public function register(Request $request)
{
    $request->validate(
        [
            'fullname' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        // ⬇️  Pesan kustom
        [
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'email.email'  => 'Format email tidak valid.',
            // contoh pesan lain (opsional)
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]
    );

    $user = User::create([
        'name'     => $request->fullname,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'user',
        'is_admin' => 0,
        'subscription_status' => 'non-aktif',
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');

}


    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'min:8'],
    ]);

    $userExists = User::where('email', $request->email)->exists();

    if (!$userExists) {
        return back()->with('error', 'Akun belum terdaftar, mohon daftar dahulu.');
    }

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember'); // menangani checkbox remember

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        // ✅ Simpan email ke cookie jika "remember me" dicentang
        if ($remember) {
            Cookie::queue('email', $request->email, 60 * 24 * 30); // 30 hari
        }

        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->intended('/admin/dashboard');
        }

        if ($user->subscription_status === 'aktif') {
            return redirect()->intended('/subs/beranda');
        }

        return redirect()->intended('/');
    }

    return back()->with('error', 'Email atau kata sandi salah.');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}