<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body', 'slug', 'category_id', 'user_id']; // Only allow these to be mass-assginable. Anything out of this uses the default values even specified in the create statement
    // protected $guarded = ['id']; // Allow everything to be assigned other than the id. Even if you have the id in the query, the default value is used as specified in the table

    // Use this for the route to search by the slug instead of the default id
    // Also this is used if you dont specify the key in the route ({post:slug})
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    protected $with = ['category', 'author']; // Adding this will always load the category and author relationships when retrieving a Post model - Eager loading

    public function scopeFilter($query, array $filters)
    {
        // If there is a search parameter, pick all posts where the title or body is like the search parameter
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%');
        });
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
