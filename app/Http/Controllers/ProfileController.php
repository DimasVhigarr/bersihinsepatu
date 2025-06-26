<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\Package;
use App\Models\Course;
use App\Models\User;

class ProfileController extends Controller
{
public function edit()
{
    $user = Auth::user();

    $subscription = $user->subscriptions()
        ->where('status', 'Aktif')
        ->latest()
        ->first();

    $package = $subscription ? Package::find($subscription->package_id) : null;

    // ✅ Tambahkan ini
    $allApproved = $user->quizAnswers()
        ->where('approved', true)
        ->count() === Course::count();

    return view('userberlangganan.kelolasubs', compact('user', 'subscription', 'package', 'allApproved'));
}

public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

public function show()
{
    $user = auth()->user();

    $subscription = $user->subscription;
    $package = $subscription?->package;

    // Cek apakah semua pelatihan dan quiz disetujui admin
    $allApproved = $user->quizAnswers()
        ->where('approved', true)
        ->count() === Course::count(); // atau logika yang sesuai dengan sistemmu

    return view('profile.index', compact('user', 'subscription', 'package', 'allApproved'));
}



}
