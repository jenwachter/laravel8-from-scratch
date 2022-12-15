<?php

namespace App\Models;

use App\Traits\Revisable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Image extends Model
{
  use HasFactory;
  use Revisable;

  protected $guarded = ['id'];

  protected static function boot()
  {
    parent::boot();

    static::updating(static function ($post) {
      $revision = new Revision([
        'user_id' => Auth::id()
      ]);
      $revision->save();
      $post->revisions()->attach($revision);
    });
  }

  /**
   * @return BelongsToMany
   */
  public function posts()
  {
    return $this->belongsToMany(Post::class)->withTimestamps();
  }

  /**
   * @return MorphToMany
   */
  public function revisions()
  {
    return $this->morphToMany(Revision::class, 'revisable')->withTimestamps();
  }

  /**
   * Adds a `author` property to posts
   * @return BelongsTo
   */
  public function author()
  {
    // need to specify column name because laravel assumes `post_id`
    return $this->belongsTo(User::class, 'user_id');
  }
}
