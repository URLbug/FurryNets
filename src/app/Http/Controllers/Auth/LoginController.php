<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function store(Request $request): RedirectResponse
    {
        return redirect()->route('home');
    }
}
