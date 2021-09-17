<?php
namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Because of the scope query filter, we are able to retrieve all posts and specific criteria all in the same method
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
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
