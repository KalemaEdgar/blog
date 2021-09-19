<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest'); // Show the register page. Only a guest can access this page (not logged in)

Route::post('register', [RegisterController::class, 'store'])->middleware('guest'); // Create or register the user to the database

Route::get('login', [SessionsController::class, 'create'])->middleware('guest'); // Show the login page or link if you are a guest
Route::post('login', [SessionsController::class, 'store'])->middleware('guest'); // Login the user
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth'); // Only access the logout link when the user is already signed in
