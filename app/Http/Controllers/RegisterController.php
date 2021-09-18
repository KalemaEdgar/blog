<?php
namespace App\Http\Controllers;

use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.index');
    }

    public function store()
    {
        // If the request validation fails, Laravel will automatically redirect you back to the page
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
        ]);

        User::create($attributes);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
