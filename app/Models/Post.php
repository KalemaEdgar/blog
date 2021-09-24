<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id', 'user_id']; // Only allow these to be mass-assginable. Anything out of this uses the default values even specified in the create statement

    // protected $guarded = ['id']; // Allow everything to be assigned other than the id. Even if you have the id in the query, the default value is used as specified in the table

    // If you would like model binding to always use a database column other than id when retrieving a given model class, you may override the getRouteKeyName method on the Eloquent model:
    // Also this is used if you dont specify the key in the route ({post:slug})
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    protected $with = ['category', 'author']; // Adding this will always load the category and author relationships when retrieving a Post model - Eager loading

    public function scopeFilter($query, array $filters)
    {
        // If there is a search parameter, pick all posts where the title or body is like the search parameter
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->where(
                fn ($query) => $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        // Return all posts related to a category
        // Give me the posts that have a category and specifically where the category slug matched what is supplied
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => $query->whereHas(
                'category', // This uses the relationship below
                fn ($query) => $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) => $query->whereHas(
                'author',
                fn ($query) => $query->where('username', $author)
            )
        );
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
