<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    function index(int $id, Request $request): View|JsonResponse
    {
        if($id !== 0)
        {
            if($request->isMethod('POST') && $request->ajax())
            {
                return $this->storeLike($id);
            }

            $post = $this->getPost($id);

            if(!isset($post))
            {
                abort(404);
            }

            return view('posts.detail_posts', [
                'post' => $post,
            ]);
        }

        $posts = Post::query()
        ->paginate();

        return view('posts.posts', [
            'posts' => $posts,
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

    function storeLike(int $id): JsonResponse
    {
        $like = $this->isLike($id);

        if(isset($like))
        {
            return $this->unLike($id);
        }

        $like = new Like;
        
        $like->post_id = $id;
        $like->user_id = auth()->user()->id;

        $like->save();

        return response()->json([
            'id' => $id,
            'likes' => count($this->getPost($id)->like->toArray()),
            'code' => 200,
        ]);
    }

    function unLike(int $id): JsonResponse
    {
        $like = $this->isLike($id);

        if(!isset($like))
        {
            return response()->json([
                'message' => 'error',
                'code' => 500,
            ]);
        }

        Like::query()
        ->where('post_id', $id)
        ->where('user_id', auth()->user()->id)
        ->delete();

        return response()->json([
            'id' => $id,
            'likes' => count($this->getPost($id)->like->toArray()),
            'code' => 200,
        ]);
    }

    private function isLike(int $id): RedirectResponse|Like|null
    {
        if($id === 0)
        {
            return back();
        }

        $like = Like::query()
        ->where('post_id', $id)
        ->where('user_id', auth()->user()->id)
        ->first();

        return $like;
    }
}
