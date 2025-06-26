<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman berlangganan dengan daftar paket
     */
    public function index()
    {
        $packages = Package::all();
        return view('user.berlangganan', compact('packages'));
    }

    /**
     * Proses penyimpanan pembayaran
     */
    public function store(Request $request)
{
    $user = auth()->user();

    if ($user->subscription_status === 'aktif') {
        return redirect()->route('subs.beranda')->with('error', 'Anda sudah berlangganan dan tidak bisa melakukan pembayaran lagi.');
    }

    $validated = $request->validate([
        'package_id' => 'required|exists:packages,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'payment_method' => 'required|in:bank_transfer,qr_code',
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    try {
        $package = Package::findOrFail($validated['package_id']);
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        Payment::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $path,
            'amount' => $package->price,
            'status' => 'pending',
        ]);

        return redirect()->route('berlangganan.index')->with('success', 'Pembayaran berhasil dikirim.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage());
    }
}

}
