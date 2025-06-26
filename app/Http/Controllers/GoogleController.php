<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account consent'])
            ->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
        ]);

        Auth::login($user);

        // ✅ Ambil status langganan user dari kolom users.subscription_status
        if ($user->subscription_status === 'aktif') {
            return redirect()->route('subs.beranda');
        }

        // Jika belum berlangganan
        return redirect('/');
        
    } catch (\Exception $e) {
        return redirect('/login')->withErrors('Login gagal, coba lagi.');
    }
}
}
