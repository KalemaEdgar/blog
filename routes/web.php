<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

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
Route::get('ping', function () {
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us5'
    ]);

    // $response = $mailchimp->ping->get(); // Health check for the Mailchimp API
    // $response = $mailchimp->lists->getAllLists(); // Get all lists
    // $response = $mailchimp->lists->getList('76607106aa'); // Get my list info
    // $response = $mailchimp->lists->getListMembersInfo('76607106aa'); // Get my list members
    $response = $mailchimp->lists->addListMember('76607106aa', [
        'email_address' => 'laravel@gmail.com',
        'status' => 'subscribed',
    ]); // Add a member to a list

    dd($response);
});

Route::fallback(function () {
    echo 'This is a fallback route incase you need to do something when a route doesnot exist but donot want to use the Laravel default pages which are great.';
});
