<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'like',
        'description',
        'tags',
        'file',
        'user_id',
    ];

    function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    function getUser(int $id): Post
    {
        return Post::find($id)
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->first();
    }
}
