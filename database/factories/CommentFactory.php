<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::factory(), // This means that if you dont explicitly send a post id in the seeder, the factory will create a post and associate the comment to it.
            'user_id' => User::factory(), // author of the comment
            'body' => $this->faker->text(),
            'active' => true,
        ];
    }
}
