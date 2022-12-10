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

      Post::factory(5)->create();
      Image::factory(5)->create();
    }
}
