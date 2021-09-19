<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // Validate the request
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate and login the user based on the provided credentials
        // attempt() checks the credentials and also logs the user in
        if (Auth::attempt($attributes)) {
            // Redirect with a success flash message
            return redirect('/')->with('success', 'Welcome Back, ' . auth()->user()->name);
        }

        // Incase the validation is successful but the credentials are wrong
        return back()
            ->withInput() // Return the old supplied form data so the user doesnot have to re-enter them
            ->withErrors(['email' => 'Your provided credentials could not be verified']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
