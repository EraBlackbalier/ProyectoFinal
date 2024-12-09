<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/officers', function () {
        return view('officers');
    })->name('officers');

    Route::get('/activities', function () {
        return view('activities');
    })->name('activities');

    Route::get('/bullet-tracker', function () {
        return view('bullet');
    })->name('bullet-tracker');
});
