<?php
namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Because of the scope query filter, we are able to retrieve all posts and specific criteria all in the same method
        return view('posts.index', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString(), // Adds the pagination URI to the current query string URI
        ]);
    }

    public function show(Post $post)
    {
        // Uses Route Model Binding to inject the Post model corresponding to the slug
        // Find a post by its slug and pass it to a view "posts/show.blade.php"
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
