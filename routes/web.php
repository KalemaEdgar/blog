<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

// RESTful methods
// index - Show all results
// show - Show one result (details)
// create - Display the create page
// store - Create the resource
// edit - Display the update page
// update - Update the resource
// destroy - Destroy or delete the resource

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

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

// Mailchimp for newsletters
Route::post('newsletter', function () {
    request()->validate([
        'email' => 'required|email'
    ]);

    try {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us5'
        ]);

        $response = $mailchimp->lists->addListMember('76607106aa', [
            'email_address' => request('email'),
            'status' => 'subscribed',
        ]);
    } catch (\Exception $e) {
        logger($e->getMessage());
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')
        ->with('success', 'You are now signed up for our newsletter.');
});

Route::fallback(function () {
    echo 'This is a fallback route incase you need to do something when a route doesnot exist but donot want to use the Laravel default pages which are great.';
});
