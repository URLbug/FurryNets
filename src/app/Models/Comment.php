<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'description',
        'user_id',
        'post_id'
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
