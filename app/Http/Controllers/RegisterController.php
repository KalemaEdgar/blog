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
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:8',
        ]);

        User::create($attributes);

        return redirect('/');
    }
}
