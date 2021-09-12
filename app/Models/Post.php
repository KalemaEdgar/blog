<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

    public static function all()
    {
        // $files = File::files(resource_path('posts'));
        // return array_map(fn ($file) => $file->getContents(), $files);

        // Find all the files in the posts directory and collect them
        // Loop or map over each item and parse that file into a document
        // Once you have a collection of documents, map over it a second time and build our Post object
        // Pass the Post object to the view

        return collect(File::files(resource_path('posts')))
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            ->map(fn ($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->body(),
                $document->date,
                $document->slug,
            ));
    }

    /**
     * This finds a post by a slug.
     * resource_path -- Gets the path to the resources folder.
     * If the post is not found, then throw a ModelNotFoundException
     */
    public static function find($slug)
    {
        // Of all the blog posts, find the one with a slug that matches the one requested
        $posts = static::all(); // $posts is a collection at this point
        return $posts->firstWhere('slug', $slug);
    }
}
