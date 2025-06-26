<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    // Field yang bisa diisi
    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
    ];

    // Field tanggal (created_at, updated_at, deleted_at)
    protected $dates = ['deleted_at'];

    // Relasi ke users (Many-to-Many)
    public function users()
{
    return $this->belongsToMany(User::class, 'course_user')
                ->withTimestamps()
                ->withPivot('is_completed', 'watched_at');
}

// app/Models/Course.php
public function quizzes()
{
    return $this->hasMany(Quiz::class);
}


    // Relasi ke subscriptions (One-to-Many)
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Accessor URL image
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Accessor URL video
    public function getVideoUrlAttribute()
    {
        return $this->video ? asset('storage/' . $this->video) : null;
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($course) {
        $course->slug = Str::slug($course->title);
    });
}
}
