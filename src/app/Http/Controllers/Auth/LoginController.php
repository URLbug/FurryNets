<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index(Request $request): View|RedirectResponse
    {
        if($request->isMethod('POST'))
        {
            return $this->store($request);
        }

        return view('auth.login');
    }

    function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember_me' => 'string',
        ]);

        $isAuth = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], isset($data['remember_me']));

        if(!$isAuth)
        {
            return back()
            ->withErrors('Incorrect password or login');
        }

        return redirect()->route('profile', [
            'username' => auth()->user()->username,
        ])->with('success', 'You have successfully logged in!');
    }

    function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
