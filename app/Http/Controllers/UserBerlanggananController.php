<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course; 
use App\Models\Package;
use App\Models\User; 
use App\Models\Subscription; 
use App\Models\QuizAnswer; 

class UserBerlanggananController extends Controller
{
    public function beranda()
{
    $user = Auth::user();
    $subscription = $user->activeSubscription;
    $package = $subscription?->package;

    $courses = Course::latest()->get()->sortBy(function ($course) {
        preg_match('/\d+/', $course->title, $matches);
        return isset($matches[0]) ? (int) $matches[0] : 0;
    });

    return view('userberlangganan.berandasubs', compact('courses', 'subscription', 'package'));
}



    public function kelola()
{
    $user = Auth::user();
    $subscription = $user->activeSubscription;
    $package = $subscription?->package;

    $courses = Course::all();
    $totalCourses = $courses->count();
    $completedCourses = $user->courses()->wherePivot('is_completed', true)->count();
    $completedAllCourses = $totalCourses > 0 && $completedCourses === $totalCourses;

    $quizAnswers = QuizAnswer::where('user_id', $user->id)->get();

    // Logika ALL approved seperti pelatihan
    $allApproved = true;
    foreach ($courses as $course) {
        $quiz = $quizAnswers->firstWhere('course_id', $course->id);
        if (!$quiz || !$quiz->approved) {
            $allApproved = false;
            break;
        }
    }

    return view('userberlangganan.kelolasubs', compact(
        'user', 'subscription', 'package', 'allApproved', 'completedAllCourses'
    ));
}



public function pelatihan()
{
    $user = Auth::user();
    $courses = Course::all();

    $subscription = Subscription::where('user_id', $user->id)
        ->where('status', 'aktif')
        ->latest()
        ->first();

    $package = $subscription ? $subscription->package : null;

    $totalCourses = $courses->count();
    $completedCourses = $user->courses()->wherePivot('is_completed', true)->count();
    $completedAllCourses = $totalCourses > 0 && $completedCourses === $totalCourses;

    $quizAnswers = QuizAnswer::where('user_id', $user->id)->get();

    $coursesStatus = [];

    foreach ($courses as $course) {
        $pivot = $user->courses()->where('course_id', $course->id)->first()?->pivot;
        $isCompleted = $pivot?->is_completed ?? false;

        $quiz = $quizAnswers->firstWhere('course_id', $course->id);

        if ($quiz && $quiz->approved) {
            $coursesStatus[$course->id] = 'approved';
        } elseif ($isCompleted && $quiz && !$quiz->approved) {
            $coursesStatus[$course->id] = 'waiting';
        } else {
            $coursesStatus[$course->id] = 'incomplete';
        }
    }

    // ✅ Perhitungan allApproved yang lebih aman
    $allApproved = true;
    foreach ($courses as $course) {
        $quiz = $quizAnswers->firstWhere('course_id', $course->id);
        if (!$quiz || !$quiz->approved) {
            $allApproved = false;
            break;
        }
    }

    return view('userberlangganan.pelatihansubs', compact(
        'courses',
        'package',
        'completedAllCourses',
        'allApproved',
        'coursesStatus'
    ));
}


    public function tentangKami()
    {
        return view('userberlangganan.tentangkamisubs');
    }

    public function tontonVideo($slug)
{
    $user = Auth::user(); // ambil user yang sedang login
    $course = Course::where('slug', $slug)->firstOrFail();

    // Update atau attach relasi course_user
    if (!$user->courses->contains($course->id)) {
        $user->courses()->attach($course->id, [
            'is_completed' => true,
            'watched_at' => now(),
        ]);
    } else {
        $user->courses()->updateExistingPivot($course->id, [
            'is_completed' => true,
            'watched_at' => now(),
        ]);
    }

    return view('userberlangganan.detailvideo', compact('course'));
}

public function markAsWatched($id)
{
    $user = Auth::user();

    // Jika belum pernah ditonton, attach
    if (!$user->courses()->where('course_id', $id)->exists()) {
        $user->courses()->attach($id, [
            'is_completed' => true,
            'watched_at' => now(),
        ]);
    } else {
        // Kalau sudah, update status-nya
        $user->courses()->updateExistingPivot($id, [
            'is_completed' => true,
            'watched_at' => now(),
        ]);
    }

    return response()->json(['success' => true]);
}

public function sertifikat()
{
    $user = Auth::user();

    // Cek apakah semua quiz yang dikerjakan user sudah disetujui (approved)
    $allApproved = !QuizAnswer::where('user_id', $user->id)
        ->where('approved', false)
        ->exists();

    // Tetap bisa cek apakah semua course sudah diselesaikan (opsional)
    $totalCourses = Course::count();
    $completedCourses = $user->courses()->wherePivot('is_completed', true)->count();
    $completedAllCourses = $totalCourses > 0 && $completedCourses >= $totalCourses;

    return view('userberlangganan.sertifikat', compact(
        'user', 
        'completedAllCourses',
        'allApproved'
    ));
}



}

