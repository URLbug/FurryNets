<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')
->group(function() {
    Route::get('/', function(){
        return view('index');
    })->name('home');

    Route::match(
        ['get', 'post'],
        '/login',
        'Auth\LoginController@index'
    )->name('login');

    Route::get('/regs', function(){
        return view('auth.regs');
    })->name('regs');

    Route::middleware('auth')
    ->group(function() {
        Route::get('/profile', function() {
            return view('profile');
        })->name('profile');
    });
});