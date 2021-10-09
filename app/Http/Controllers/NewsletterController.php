<?php

namespace App\Http\Controllers;

use App\Services\NewsLetter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    // Use __invoke() if the controller only has 1 method (Single action controller)
    // https://laravel.com/docs/8.x/controllers#single-action-controllers
    public function __invoke(NewsLetter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
            logger($e->getMessage());
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter.');
    }
}
