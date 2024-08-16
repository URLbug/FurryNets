<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    function index(Request $request): View
    {
        $post = Post::query()
        ->paginate();

        return view('posts.posts', [
            'posts' => $post,
        ]);
    }
}
