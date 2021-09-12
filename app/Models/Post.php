<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;
    public $excerpt;
    public $body;
    public $date;
    public $slug;

    public function __construct($title, $excerpt, $body, $date, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->body = $body;
        $this->date = $date;
        $this->slug = $slug;
    }

    /**
     * This finds a post by a slug.
     * resource_path -- Gets the path to the resources folder.
     * If the post is not found, then throw a ModelNotFoundException
     */
    public static function find($slug)
    {
        if (!file_exists($path = resource_path("posts/$slug.html"))) {
            return new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", 5, fn () => file_get_contents($path));
    }

    public static function all()
    {
        $files = File::files(resource_path('posts'));
        return array_map(fn ($file) => $file->getContents(), $files);
    }
}
