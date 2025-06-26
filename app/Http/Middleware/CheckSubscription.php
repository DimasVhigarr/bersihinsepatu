<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): mixed
{
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    // Ambil langganan aktif terakhir
    $subscription = $user->subscription()
        ->where('status', 'Aktif')
        ->latest()
        ->first();

    // Jika subscription ditemukan dan sudah expired
    if ($subscription && now()->gt($subscription->end_date)) {
        $subscription->status = 'Expired';
        $subscription->save();

        // Update user status tanpa logout
        $user->subscription_status = 'non-aktif';
        $user->save();
    }

    // Cek ulang dari database (tidak gunakan cache session)
    $freshUser = $user->fresh(); // ambil data terbaru dari DB

    // Redirect hanya jika status benar-benar non-aktif dan tidak ada subscription aktif
    if ($freshUser->subscription_status !== 'aktif') {
        return redirect('/')->with('error', 'Anda belum berlangganan.');
    }

    return $next($request);
}

}
