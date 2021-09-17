<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            // 'posts' => Post::latest()->filter(request()->only('search'))->get(), // Either this
            'posts' => Post::latest()->filter(request(['search']))->get(), // Or this (create an array for the query scope from request())
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        // Find a post by its slug and pass it to a view called "post"
        return view('post', [
            'post' => $post
        ]);
    }
}
