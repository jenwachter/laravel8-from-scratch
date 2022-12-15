<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function revisions()
  {
    return $this->morphToMany(Revision::class, 'revisable')->withTimestamps();
  }

  /**
   * @return BelongsToMany
   */
  public function posts()
  {
    return $this->belongsToMany(Post::class)->withTimestamps();
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
