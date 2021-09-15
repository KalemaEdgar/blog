<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->sentence(10),
            'body' => $this->faker->paragraph(),
            'user_id' => User::factory(), // By default, this will create a new user each time the factory runs
            'category_id' => Category::factory(), // By default, this will create a new category each time the factory runs
        ];
    }
}
