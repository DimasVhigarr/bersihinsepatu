<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Menampilkan quiz untuk course tertentu
    public function showCourseQuiz(Course $course)
    {
        $quizzes = $course->quizzes;
        return view('admin.course_quiz', compact('course', 'quizzes'));
    }

    // Halaman kelola quiz
    public function manageQuiz($id)
    {
        $course = Course::findOrFail($id);
        $quizzes = Quiz::where('course_id', $id)->get();
        return view('admin.quiz_manage', compact('course', 'quizzes'));
    }

    // Simpan quiz baru
    public function storeQuiz(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array',
            'correct_answer' => 'required|string|in:A,B,C,D',
        ]);

        Quiz::create([
            'course_id' => $id,
            'question' => $request->question,
            'options' => json_encode($request->options),
            'correct_answer' => $request->correct_answer,
        ]);

        return back()->with('success', 'Quiz berhasil ditambahkan!');
    }

    // Simpan jawaban quiz dari user
    // public function submitQuiz(Request $request, $courseId)
    // {
    //     $user = Auth::user();

    //     foreach ($request->answers as $quizId => $selectedAnswer) {
    //         QuizAnswer::updateOrCreate(
    //             [
    //                 'user_id' => $user->id,
    //                 'quiz_id' => $quizId,
    //                 'course_id' => $courseId,
    //             ],
    //             [
    //                 'answer' => $selectedAnswer,
    //                 'approved' => false,
    //             ]
    //         );
    //     }

    //     return redirect()->back()->with('success', 'Jawaban Anda telah dikirim.');
    // }

    // Menampilkan hasil quiz dari semua user
    public function quizResults()
{
    $results = QuizAnswer::with(['user.subscription', 'course'])
        ->get()
        ->groupBy('user_id');

    return view('admin.quiz', compact('results'));
}


    public function approveUser($userId)
{
    $user = User::findOrFail($userId); // validasi user ada

    QuizAnswer::where('user_id', $userId)->update([
        'approved' => true,
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Semua quiz user telah disetujui.');
}


    // Menyetujui jawaban quiz tertentu
    public function approveQuiz($id)
    {
        $answer = QuizAnswer::findOrFail($id);
        $answer->approved = true;
        $answer->save();

        return back()->with('success', 'Quiz disetujui untuk: ' . $answer->user->name);
    }

   public function submit(Request $request, $courseId)
{
    $userId = auth()->id();
    $course = Course::with('quizzes')->findOrFail($courseId);
    $answers = $request->input('answers');

    $totalQuestions = $course->quizzes->count();
    $correctAnswers = 0;

    foreach ($course->quizzes as $quiz) {
        if (isset($answers[$quiz->id]) && $answers[$quiz->id] === $quiz->correct_answer) {
            $correctAnswers++;
        }
    }

    // Hitung skor dalam bentuk persen
    $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;

    $existing = QuizAnswer::where('user_id', $userId)
                          ->where('course_id', $courseId)
                          ->first();

    // Update hanya jika skor baru lebih tinggi
    if (!$existing || $score > $existing->score) {
        QuizAnswer::updateOrCreate(
            ['user_id' => $userId, 'course_id' => $courseId],
            ['score' => $score, 'approved' => false]
        );
    }

    return redirect()->back()->with('success', 'Quiz berhasil dikirim.');
}



public function retry($courseId)
{
    $userId = auth()->id();

    // Hapus jawaban quiz lama
    $existing = QuizAnswer::where('user_id', $userId)->where('course_id', $courseId)->first();
    if ($existing) {
        $existing->delete();
    }

    // Ambil slug course
    $course = Course::findOrFail($courseId);

    // Redirect pakai slug
    return redirect()->route('video.tonton', $course->slug)
        ->with('success', 'Silakan ulangi quiz Anda.');
}



}
