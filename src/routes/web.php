<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App/Http/Controllers')
->group(function() {
    Route::get('/', function(){
        return view('index');
    })->name('home');

    Route::get('/login', function(){
        return view('auth.login');
    })->name('login');

    Route::get('/regs', function(){
        return view('auth.regs');
    })->name('regs');
});