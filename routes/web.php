<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserBerlanggananController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\QuizController;

// ========================
// Public Routes
// ========================
Route::get('/', [UserController::class, 'beranda']);
Route::get('/pelatihan', [UserController::class, 'pelatihan']);
Route::get('/tentangkami', [UserController::class, 'tentangKami']);
Route::get('/daftar', [UserController::class, 'daftar']);

// ========================
// Auth Routes
// ========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/daftar', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================
// Google Login
// ========================
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// ========================
// User Berlangganan Routes
// ========================
Route::middleware(['auth', 'check.subscription'])->group(function () {
    Route::get('/subs/beranda', [UserBerlanggananController::class, 'beranda'])->name('subs.beranda');
    Route::get('/subs/pelatihan', [UserBerlanggananController::class, 'pelatihan'])->name('subs.pelatihan');
    Route::get('/subs/tentangkami', [UserBerlanggananController::class, 'tentangKami'])->name('subs.tentangkami');
    Route::get('/subs/kelola', [UserBerlanggananController::class, 'kelola'])->name('subs.kelola');
    Route::get('/subs/sertifikat', [UserBerlanggananController::class, 'sertifikat'])->name('subs.sertifikat');
    Route::get('/sertifikat/download', [SertifikatController::class, 'download'])->name('download.sertifikat');
    Route::get('/video/{slug}', [UserBerlanggananController::class, 'tontonVideo'])->name('video.tonton');
});

// ========================
// Tracking Video Ditonton
// ========================
Route::post('/video/{id}/watch', [UserBerlanggananController::class, 'markAsWatched'])->middleware('auth');

// ========================
// Profile Routes (auth)
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ========================
// Berlangganan & Pembayaran
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/berlangganan', [PaymentController::class, 'index'])->name('berlangganan.index');
    Route::post('/berlangganan', [PaymentController::class, 'store'])->name('berlangganan.submit');
    Route::get('/sertifikat/preview', [SertifikatController::class, 'preview'])->name('preview.sertifikat');
});

// ========================
// Quiz Routes (User)
// ========================
Route::middleware('auth')->group(function () {
    Route::post('/courses/{course}/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::post('/quiz/{course}/retry', [QuizController::class, 'retry'])->name('quiz.retry');
});

// ========================
// Admin Routes
// ========================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/dashboard/{id}/approve', [AdminController::class, 'approve'])->name('admin.dashboard.approve');
    Route::post('/dashboard/{id}/reject', [AdminController::class, 'reject'])->name('admin.dashboard.reject');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');

    // Courses
    Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::post('/courses/store', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::delete('/courses/{id}', [AdminController::class, 'coursedestroy'])->name('admin.courses.destroy');
    Route::get('/courses/{id}/edit', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::put('/courses/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::get('/courses/{id}/edit-data', [AdminController::class, 'editData'])->middleware(['auth', 'admin'])->name('admin.courses.editData');

    // Quizzes
    Route::get('/courses/{course}/quizzes', [QuizController::class, 'showCourseQuiz'])->name('admin.courses.quizzes');
    Route::get('/quiz/manage/{id}', [QuizController::class, 'manageQuiz'])->name('admin.quiz.manage');
    Route::post('/courses/{id}/quiz', [QuizController::class, 'storeQuiz'])->name('admin.quiz.store');
    Route::get('/quiz', [QuizController::class, 'quizResults'])->name('admin.quiz.results');
    Route::post('/quiz/approve-user/{user}', [QuizController::class, 'approveUser'])->name('admin.quiz.approveUser');
    Route::post('/quiz/{id}/approve', [QuizController::class, 'approveQuiz'])->name('admin.quiz.approve');

    // Packages
    Route::get('/packages', [AdminPackageController::class, 'index'])->name('admin.packages.index');
    Route::post('/packages', [AdminPackageController::class, 'store'])->name('admin.packages.store');
    Route::delete('/packages/{id}', [AdminPackageController::class, 'destroy'])->name('admin.packages.destroy');
    Route::put('/packages/{id}', [AdminPackageController::class, 'update'])->name('admin.packages.update');

    // Subscriptions
    Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('admin.subscriptions');
    Route::post('/subscriptions', [AdminController::class, 'storeSubscription'])->name('admin.subscriptions.store');

    // Payment History
    Route::get('/payments/history', [AdminController::class, 'paymentHistory'])->name('admin.payments.history');
});
