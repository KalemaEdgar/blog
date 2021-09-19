<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // Validate the request
        // If the validation fails, Laravel automatically redirect you back with proper error messages
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate and login the user based on the provided credentials
        // attempt() checks the credentials and also logs the user in
        if (Auth::attempt($attributes)) {
            request()->session()->regenerate(); // Regenerate the session Id to prevent session fixation
            // Redirect with a success flash message
            return redirect('/')->with('success', 'Welcome Back, ' . auth()->user()->name);
        }

        // Incase the validation is successful but the credentials are wrong
        // return back()
        //     ->withInput() // Return the old supplied form data so the user doesnot have to re-enter them
        //     ->withErrors(['email' => 'Your provided credentials could not be verified']);

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
