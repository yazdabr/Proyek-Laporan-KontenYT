<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/lapinput', function () {
    return view('lapinput');
});

Route::get('/lapdashboard', function () {
    return view('lapdashboard');
});