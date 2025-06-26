<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Quiz;
use App\Models\QuizAnswer;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil hanya payment yang masih pending saja
    $payments = Payment::with('user')
        ->where('status', 'pending')
        ->latest()
        ->get();

    $totalUsers = User::count();
    $totalPackages = Package::count();
    $totalCourses = Course::count();
    $totalPayments = Payment::count();
    $totalSubscriptions = Subscription::where('status', 'aktif')->count();

    return view('admin.dashboard', compact(
        'payments',
        'totalUsers',
        'totalPackages',
        'totalCourses',
        'totalPayments',
        'totalSubscriptions'
    ));
}

    public function approve($id)
{
    $payment = Payment::findOrFail($id);
    $payment->status = 'approved';
    $payment->save();

    // ✅ Aktifkan langganan user
    $user = $payment->user;
    $user->subscription_status = 'aktif';
    $user->save();

    // (Opsional) buat entri di tabel `subscriptions`
    Subscription::create([
        'user_id' => $user->id,
        'package_id' => $payment->package_id,
        'name' => $payment->name,
        'status' => 'Aktif',
        'start_date' => now(),
        'end_date' => now()->addMonth(),
    ]);

    return redirect()->back()->with('success', 'Pembayaran disetujui dan langganan diaktifkan.');
}



    public function reject($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'rejected';
        $payment->save();

        return redirect()->route('admin.dashboard')->with('success', 'Pembayaran ditolak.');
    }

    public function paymentHistory()
{
    $allPayments = Payment::with(['user', 'package'])->latest()->get();
    return view('admin.payment_history', compact('allPayments'));
}


    // View all courses
    public function courses()
{
    $courses = Course::latest()->get();         // ⛔️ ini pakai `latest()`, artinya diurutkan DESC berdasarkan `created_at`
    $courses = Course::with('quizzes')->get();  // ⛔️ ini menimpa baris atas, jadi `latest()` jadi tidak berlaku
    return view('admin.courses', compact('courses'));
}


    // View all subscriptions
    public function subscriptions()
    {
        $subscriptions = Subscription::with(['user', 'package'])->latest()->get();
        return view('admin.subscriptions', compact('subscriptions'));
    }

    // View all users
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    // Store new course
    public function storeCourse(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'video' => 'nullable|mimes:mp4,mov,avi|max:51200',

        // ✅ Validasi pertanyaan quiz
        'quiz_questions.*.question' => 'required|string',
        'quiz_questions.*.option_a' => 'required|string',
        'quiz_questions.*.option_b' => 'required|string',
        'quiz_questions.*.option_c' => 'required|string',
        'quiz_questions.*.option_d' => 'required|string',
        'quiz_questions.*.correct_answer' => 'required|in:A,B,C,D',
    ]);

    $course = new Course();
    $course->title = $request->title;
    $course->description = $request->description;

    if ($request->hasFile('image')) {
        $course->image = $request->file('image')->store('courses/images', 'public');
    }

    if ($request->hasFile('video')) {
        $course->video = $request->file('video')->store('courses/videos', 'public');
    }

    $course->save(); // ⬅️ Simpan dulu course

    // ⬇️ Tambahkan ini untuk simpan quiz jika tersedia
    if ($request->has('quiz_questions')) {
        foreach ($request->quiz_questions as $quiz) {
            Quiz::create([
                'course_id' => $course->id,
                'question' => $quiz['question'],
                'option_a' => $quiz['option_a'],
                'option_b' => $quiz['option_b'],
                'option_c' => $quiz['option_c'],
                'option_d' => $quiz['option_d'],
                'correct_answer' => $quiz['correct_answer'],
            ]);
        }
    }

    return redirect()->back()->with('success', 'Course dan quiz berhasil ditambahkan');
}

    // Store new subscription
    public function storeSubscription(Request $request)
    {
       $request->validate([
    'user_id' => 'required|exists:users,id',
    'name' => 'required|string|max:255',
    'package_id' => 'required|exists:packages,id', // ✅
    'start_date' => 'required|date',
    'end_date' => 'required|date|after_or_equal:start_date',
]);

Subscription::create([
    'user_id' => $request->user_id,
    'name' => $request->name,
    'package_id' => $request->package_id, // ✅
    'status' => 'Aktif',
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
]);


        // Update status di tabel user
        User::where('id', $request->user_id)->update(['subscription_status' => 'Aktif']);

        return redirect()->back()->with('success', 'Langganan berhasil ditambahkan');
    }

   public function coursedestroy($id)
{
    $course = Course::findOrFail($id);

    // Hapus file gambar & video dari storage kalau perlu
    if ($course->image) {
        Storage::disk('public')->delete($course->image);
    }

    if ($course->video) {
        Storage::disk('public')->delete($course->video);
    }

    // Ganti dari ini:
    // $course->delete(); // hapus dari DB

    // Menjadi:
    $course->forceDelete(); // benar-benar hapus dari DB (bukan soft delete)

    return redirect()->route('admin.courses')->with('success', 'Course berhasil dihapus.');
}

// Tampilkan form edit course
public function editCourse($id)
{
    $course = Course::with('quizzes')->findOrFail($id);
    return view('admin.edit_course', compact('course'));
}


// Simpan perubahan course
public function updateCourse(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',

        // ✅ Validasi quiz
        'quiz_questions.*.question' => 'required|string',
        'quiz_questions.*.option_a' => 'required|string',
        'quiz_questions.*.option_b' => 'required|string',
        'quiz_questions.*.option_c' => 'required|string',
        'quiz_questions.*.option_d' => 'required|string',
        'quiz_questions.*.correct_answer' => 'required|in:A,B,C,D',
    ]);

    $course = Course::findOrFail($id);
    $course->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    $existingQuizIds = [];

    foreach ($request->quiz_questions as $quiz) {
        if (!empty($quiz['id'])) {
            // Update quiz
            $q = Quiz::find($quiz['id']);
            if ($q && $q->course_id == $course->id) {
                $q->update([
                    'question' => $quiz['question'],
                    'option_a' => $quiz['option_a'],
                    'option_b' => $quiz['option_b'],
                    'option_c' => $quiz['option_c'],
                    'option_d' => $quiz['option_d'],
                    'correct_answer' => $quiz['correct_answer'],
                ]);
                $existingQuizIds[] = $q->id;
            }
        } else {
            // Tambah baru
            $new = Quiz::create([
                'course_id' => $course->id,
                'question' => $quiz['question'],
                'option_a' => $quiz['option_a'],
                'option_b' => $quiz['option_b'],
                'option_c' => $quiz['option_c'],
                'option_d' => $quiz['option_d'],
                'correct_answer' => $quiz['correct_answer'],
            ]);
            $existingQuizIds[] = $new->id;
        }
    }

    // Hapus quiz yang dihapus dari UI
    Quiz::where('course_id', $course->id)
        ->whereNotIn('id', $existingQuizIds)
        ->delete();

    return redirect()->route('admin.courses')->with('success', 'Course & Quiz berhasil diperbarui.');
}


public function editData($id)
{
    $course = Course::with('quizzes')->findOrFail($id);
    return response()->json($course);
}


}
