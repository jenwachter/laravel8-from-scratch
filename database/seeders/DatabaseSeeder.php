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

      // print_r($images->random(1)->pluck('id')->first());

      array_map(static function () use ($images) {
        Post::factory(1)->create([
          'thumbnail_id' => $images->random(1)->pluck('id')->first(),
          'hero_id' => $images->random(1)->pluck('id')->first(),
        ]);
      }, range(0, 10));

      // populate posts


      // // populate the pivot table
      // Post::all()->each(function ($post) use ($images) {
      //   $post->thumbnail = $images->random(1)->pluck('id')->toArray();
      //   $post->hero = $images->random(1)->pluck('id')->toArray();
      //   // $post->thumbnail()->attach(
      //   //   $images->random(1)->pluck('id')->toArray()
      //   // );
      //   // $post->hero()->attach(
      //   //   $images->random(1)->pluck('id')->toArray()
      //   // );
      // });
    }
}
