<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    function index(string $username, Request $request): View|RedirectResponse
    {
        if(
            $request->isMethod('PATCH') &&
            $username === auth()->user()->username
        ) {
            return $this->update($request);
        }

        $user = User::query()
        ->where('username', $username);

        if(!$user->exists())
        {
            abort(404);
        }

        $user = $user->first();

        $following = Follower::query()
        ->where('user_id', $user->id)
        ->get();

        return view('profile', [
            'username' => $username,
            'user' => $user,
            'posts' => $user->post()->get(),
            'followers' => $user->follower()->get(),
            'following' => $following,
        ]);
    }

    function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'description' => 'string|max:255|nullable',
            'patreon' => 'string|url|nullable',
            'github' => 'string|url|nullable',
            'discord' => 'string|url|nullable',
            'twitter' => 'string|url|nullable',
            'tiktok' => 'string|url|nullable',
        ]);

        $user = User::query()
        ->where('username', auth()->user()->username)
        ->first();

        $user->description = $data['description'];

        unset($data['description']);

        $user->socialnetworks = $data;

        $user->save();

        return back();
    }
}
