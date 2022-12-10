<?php

namespace Database\Seeders;

use App\Models\Image;
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
      // create my user
      User::factory()->create([
        'username' => 'jen',
        'name' => 'jen',
        'email' => 'jenleighkelly@gmail.com',
      ]);

      // populate images
      $images = Image::factory(10)->create();

      // populate posts
      Post::factory(10)->create();

      // populate the pivot table
      Post::all()->each(function ($post) use ($images) {
        $post->thumbnail()->attach(
          $images->random(1)->pluck('id')->toArray()
        );
      });
    }
}
