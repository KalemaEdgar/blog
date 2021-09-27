<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        // Validate the request
        request()->validate([
            'body' => 'required'
        ]);

        // Create the comment
        $post->comments()->create([
            'user_id' => auth()->id(), // or auth()->user()->id
            'body' => request('body'),
            // The post_id is injected by Laravel since we are pulling in a Post model
        ]);

        return back();
    }
}
