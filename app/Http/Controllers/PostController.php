<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

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

    public function create()
    {
        // if (auth()->guest()) {
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        // if (auth()->user()?->email !== 'test@gmail.com') { // The '?' is to make the username optional so that incase it is null, php doesnot throw an error
        //     abort(Response::HTTP_FORBIDDEN);
        // }

        return view('posts.create');
    }
}
