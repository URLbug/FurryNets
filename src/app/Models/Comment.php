<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'description',
        'user_id',
        'post_id'
    ];

    function getUser(int $id): Comment
    {
        return Comment::find($id)
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->first();
    }
}
