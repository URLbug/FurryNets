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
    function index(string $username): View|RedirectResponse
    {
        $user = User::query()
        ->where('username', $username);

        if(!$user->exists())
        {
            return back();
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
}
