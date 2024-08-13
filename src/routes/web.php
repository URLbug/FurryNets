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

    Route::match(
        ['get', 'post',],
        '/regs',
        'Auth\RegsController@index',
    )->name('regs');

    Route::middleware('auth')
    ->group(function() {
        Route::get('/profile', function() {
            return view('profile');
        })->name('profile');

        Route::get('/logout', 'Auth\LoginController@logout')
        ->name('logout');
    });
});