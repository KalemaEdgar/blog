<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body']; // Only allow these to be mass-assginable. Anything out of this uses the default values even specified in the create statement
    // protected $guarded = ['id']; // Allow everything to be assigned other than the id. Even if you have the id in the query, the default value is used as specified in the table
}
