<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function preview()
    {
        $user = Auth::user();
        $tanggalCetak = now()->format('d F Y');

        // Validasi
        if (!$user->hasCompletedAllCourses()) {
            return redirect()->route('subs.pelatihan')->with('error', 'Anda belum menyelesaikan semua course.');
        }

        if (!$user->hasAllApprovedQuizzes()) {
            return redirect()->route('subs.pelatihan')->with('error', 'Quiz Anda belum disetujui oleh admin.');
        }

        // Generate certificate code jika belum ada
        $user->generateCertificateCode();

        // Load PDF
        $pdf = Pdf::loadView('pdf.sertifikat', [
            'user' => $user,
            'tanggalCetak' => $tanggalCetak,
            'kodeUnik' => $user->certificate_code,
        ]);

        return $pdf->stream('sertifikat-' . $user->name . '.pdf');
    }
}

