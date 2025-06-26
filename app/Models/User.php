<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Course;
use App\Models\Subscription; // ⬅ INI PENTING!


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi (mass assignment).
     */
    protected $fillable = [
    'user_id',
    'name',
    'email',
    'subscription_status', // tambah ini
    'created_at',
    'password',
    'role',
    'is_admin',
];
    /**
     * Atribut yang harus disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang perlu dikonversi.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke tabel pivot courses (Many-to-Many).
     */
    public function courses()
{
    return $this->belongsToMany(Course::class)->withPivot('is_completed', 'watched_at')->withTimestamps();
}
    /**
     * Relasi ke subscriptions (One-to-Many).
     */
    public function subscription()
{
    return $this->hasOne(Subscription::class)->where('status', 'aktif');
}

    /**
     * Cek apakah user ini admin
     */
    public function isAdmin()
    {
    return $this->role === 'admin' || $this->is_admin == 1;
    }

    public function getFormattedSubscriptionStatusAttribute()
    {
        switch ($this->subscription_status) {
            case 'Aktif':
                return '<span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>';
            case 'Nonaktif':
                return '<span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">Nonaktif</span>';
            case 'Expired':
                return '<span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Expired</span>';
            default:
                return '<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Tidak Diketahui</span>';
        }
    }

    // app/Models/User.php
public function activeSubscription()
{
    return $this->hasOne(Subscription::class)->where('status', 'Aktif')->latestOfMany();
}

public function hasCompletedAllCourses()
{
    $totalCourses = Course::count();
    $completedCourses = $this->courses()->wherePivot('is_completed', true)->count();

    return $totalCourses > 0 && $completedCourses === $totalCourses;
}

public function hasAllApprovedQuizzes()
{
    return !\App\Models\QuizAnswer::where('user_id', $this->id)
        ->where('approved', false)
        ->exists();
}



}
