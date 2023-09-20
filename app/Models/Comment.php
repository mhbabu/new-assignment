<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['blog_id', 'user_id', 'comment', 'created_by', 'updated_by'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
