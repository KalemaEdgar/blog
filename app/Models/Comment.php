<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        // Laravel uses the function name to determine the foreign key id
        // In this case, it would be author_id hence the need to explicitly specify the column below as user_id
        return $this->belongsTo(User::class, 'user_id');
    }
}
