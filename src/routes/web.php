<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')
->group(function() {
    Route::get('/', function(){
        return !auth()->check() 
        ? view('index') 
        : redirect()->route('profile', [
            'username' => auth()->user()->username,
        ]);
    })->name('home');

    Route::match(
        ['get', 'post'],
        '/login',
        'Auth\LoginController@index'
    )->name('login');

    Route::match(
        ['get', 'post',],
        '/regs',
        'Auth\RegsController@index',
    )->name('regs');

    Route::middleware('auth')
    ->group(function() {
        Route::match(
            ['get', 'patch'],
            '/profile/{username}', 
            'Profile\ProfileController@index'
        )->name('profile');

        Route::get('/posts', 'Post\PostController@index')
        ->name('posts');

        Route::get('/logout', 'Auth\LoginController@logout')
        ->name('logout');
    });
});