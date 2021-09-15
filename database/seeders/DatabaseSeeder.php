<?php
namespace Database\Seeders;

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
        // This will create 5 users each with a post (5 posts) and 5 categories
        // Post::factory(5)->create();

        // Incase you want to have all the posts owned by 1 user
        $user = User::factory()->create([
            'name' => 'Kalema Edgar'
        ]);

        // We will still have 5 categories, 5 posts but all owned by 1 user created above
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}
