<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    function index(int $id, Request $request): View
    {
        if($id !== 0)
        {
            $post = $this->getPost($id);

            return view('posts.detail_posts', [
                'post' => $post,
            ]);
        }

        $post = Post::query()
        ->paginate();

        return view('posts.posts', [
            'posts' => $post,
        ]);
    }

    function getPost(int $id): ?Post
    {
        $post = Post::query()
        ->where('id', $id);

        if(isset($post))
        {
            return $post->first();
        }

        return null;
    }
}
