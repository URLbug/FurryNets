<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    function index(int $id, Request $request): RedirectResponse
    {
        if($request->isMethod('POST'))
        {   
            if($id !== 0)
            {
                return $this->storeLike($id);
            }

            return $this->storeComment($request);
        }

        return back();
    }

    function getComment($id): ?Comment
    {
        $comment = Comment::query()
        ->where('id', $id);

        if(isset($comment))
        {
            return $comment->first();
        }

        return null;
    }

    function storeComment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'text' => 'required|string',
            'post' => 'required|int'
        ]);

        $comment = new Comment;

        $comment->user_id = auth()->user()->id;
        $comment->post_id = $data['post'];
        $comment->description = $data['text'];

        $comment->save();

        return back();
    }

    function unLike(int $id): RedirectResponse 
    {
        $comment = $this->isLike($id);

        if($comment->like->toArray() === [])
        {
            return $this->unLike($id);
        }

        Like::query()
        ->where('comment_id', $id)
        ->delete();

        return back();
    }
    
    function storeLike(int $id): RedirectResponse 
    {
        $comment = $this->isLike($id);

        if($comment->like->toArray() !== [])
        {
            return $this->unLike($id);
        }

        $like = new Like;

        $like->comment_id = $id;
        $like->user_id = auth()->user()->id;

        $like->save();

        return back();
    }

    private function isLike(int $id): RedirectResponse|Comment
    {
        $comment = $this->getComment($id);

        if(!isset($comment))
        {
            return back();
        }

        return $comment;
    }
}
