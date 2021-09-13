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
        // To refresh the cache, use cache()->forget('posts.all'); and then refresh the page to pick fresh records
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path('posts')))
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            ->map(fn ($document) => new Post(
                $document->title,
                $document->excerpt,
                $document->body(),
                $document->date,
                $document->slug,
            ))
            ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);
        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
