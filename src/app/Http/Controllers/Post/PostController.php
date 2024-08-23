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
        $post = $this->isLike($id);

        if($post->like->toArray() !== [])
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
        $post = $this->isLike($id);

        if($post->like->toArray() === [])
        {
            return response()->json([
                'message' => 'error',
                'code' => 500,
            ]);
        }

        Like::query()
        ->where('post_id', $id)
        ->delete();

        return response()->json([
            'id' => $id,
            'likes' => count($this->getPost($id)->like->toArray()),
            'code' => 200,
        ]);
    }

    private function isLike(int $id): RedirectResponse|Post
    {
        if($id === 0)
        {
            return back();
        }

        $post = $this->getPost($id);

        if(!isset($post))
        {
            abort(404);
        }

        return $post;
    }
}
