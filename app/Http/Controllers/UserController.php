<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Course; 
use App\Models\Package; 
use App\Models\Subscription;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\Factory;
use Illuminate\View\View;

class UserController extends Controller
{
    public function beranda() {
    $courses = Course::latest()->get();
    $packages = Package::all();

    return view('user.beranda', compact('courses', 'packages'));
}

    public function pelatihan() {

        $courses = Course::latest()->get();
        return view('user.pelatihan', compact('courses'));
    }

    public function berlangganan() {
    $packages = Package::all();

    return view('user.berlangganan', compact('packages'));
}

    public function tentangKami() {
        return view('user.tentangkami');
    }

    public function login()
{
    return view('auth.login'); // sebelumnya 'user.login'
}

public function daftar()
{
    return view('auth.daftar'); // sebelumnya 'user.daftar'
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->back()->with('success', 'User created');
}

public function processPayment(Request $request)
{
    $validated = $request->validate([
        'package_id' => 'required|exists:packages,id',
        'fullName' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'paymentMethod' => 'required|in:bank_transfer,qr_code',
        'paymentProof' => 'required|file|mimes:jpg,jpeg,png|max:5120',
    ]);

    $paymentProofPath = $request->file('paymentProof')->store('payment_proofs', 'public');

    $subscription = Subscription::create([
        'user_id' => auth()->id(),
        'name' => $validated['fullName'],
        'status' => 'Aktif',
        'start_date' => now(),
        'end_date' => now()->addMonth(),
        'payment_proof' => $paymentProofPath, // pastikan ada kolom ini di DB
    ]);

    return redirect()->back()->with('success', 'Pembayaran berhasil diproses. Terima kasih!');
}

public function submit(Request $request, $courseId)
{
    $course = Course::findOrFail($courseId);
    $quizzes = $course->quizzes;
    $answers = $request->input('answers');

    $score = 0;
    foreach ($quizzes as $quiz) {
        if (isset($answers[$quiz->id]) && $answers[$quiz->id] === $quiz->correct_answer) {
            $score++;
        }
    }

    QuizAnswer::updateOrCreate(
        ['user_id' => auth()->id(), 'course_id' => $courseId],
        ['score' => $score]
    );

    return back()->with('success', 'Quiz berhasil disubmit! Nilai Anda: ' . $score);
}


}
