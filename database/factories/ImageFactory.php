<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      return [
        'user_id' => User::factory(),
        'post_id' => Post::factory(),
        'name' => $this->faker->word,
        'url' => $this->faker->imageUrl(495, 384),
        'alt' => $this->faker->sentence,
        'caption' => '<p>' . $this->faker->paragraph . '</p>',
      ];
    }
}
