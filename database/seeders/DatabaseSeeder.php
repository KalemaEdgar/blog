<?php
namespace Database\Seeders;

use App\Models\Category;
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
        // Truncate the models before seeding to prevent duplicates
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user = User::factory()->create();
        // $user = User::factory(3)->create(); // Creates a collection of 3 users
        // dd($user->pluck('id')[0]);

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        Post::create([
            'title' => 'My Personal Blog',
            'slug' => 'my-personal-blog',
            'excerpt' => '<p>lorem ipsum personal related</p>',
            'body' => '<p>Here is where you can register web routes for your application. These routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. Now create something great!</p>',
            'category_id' => $personal->id,
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'My Family Blog',
            'slug' => 'my-family-blog',
            'excerpt' => '<p>lorem ipsum family related</p>',
            'body' => '<p>Here is where you can register web routes for your application. These routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. Now create something great!</p>',
            'category_id' => $family->id,
            'user_id' => $user->id,
        ]);

        Post::create([
            'title' => 'My Work Blog',
            'slug' => 'my-work-blog',
            'excerpt' => '<p>lorem ipsum work related</p>',
            'body' => '<p>Here is where you can register web routes for your application. These routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. Now create something great!</p>',
            'category_id' => $work->id,
            'user_id' => $user->id,
        ]);
    }
}
