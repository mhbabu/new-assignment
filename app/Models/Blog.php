<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = ['title', 'slug', 'details', 'created_by', 'updated_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (auth()->user()) {
                $user->created_by = auth()->user()->id ?? null;
                $user->updated_by = auth()->user()->id ?? null;
            }
        });

        static::updating(function ($user) {
            if (auth()->user())
                $user->updated_by = auth()->user()->id ?? null;
        });
    }
}
