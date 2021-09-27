<?php
namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $post = Post::factory()->create();

        // Incase you want to have all the posts owned by 1 user
        $user = User::factory()->create([
            'name' => 'Kalema Edgar',
            'email' => 'test@gmail.com',
        ]);

        // We will still have categories, posts but all owned by 1 user created above
        Post::factory(20)->create([
            'user_id' => $user->id
        ]);

        Comment::factory(3)->create([
            // 'post_id' => $post->id,
            'post_id' => 2,
            'user_id' => $user->id,
        ]);
    }
}
