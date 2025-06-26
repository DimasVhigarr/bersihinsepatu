<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\QuizAnswer;

class SertifikatController extends Controller
{
    public function preview()
{
    $user = Auth::user();
    $tanggalCetak = now()->format('d F Y');

    // ❌ Jika belum menyelesaikan semua course
    if (!$user->hasCompletedAllCourses()) {
        return redirect()->route('subs.pelatihan')->with('error', 'Anda belum menyelesaikan semua course.');
    }

    // ❌ Jika masih ada quiz yang belum disetujui
    if (!$user->hasAllApprovedQuizzes()) {
        return redirect()->route('subs.pelatihan')->with('error', 'Quiz Anda belum disetujui oleh admin.');
    }

    // ✅ Semua valid, tampilkan sertifikat PDF
    $pdf = Pdf::loadView('pdf.sertifikat', compact('user', 'tanggalCetak'));
    return $pdf->stream('sertifikat-' . $user->name . '.pdf');
}

}
