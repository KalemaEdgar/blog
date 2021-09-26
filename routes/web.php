<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// Show the register page. Only a guest can access this page (not logged in)
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
// Create or register the user to the database
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

// Show the login page or link if you are a guest
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
// Validate the user details and log them in
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
// Only access the logout link if the user is already signed in using the middleware
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::fallback(function () {
    echo 'This is a fallback route incase you need to do something when a route doesnot exist but donot want to use the Laravel default pages which are great.';
});
