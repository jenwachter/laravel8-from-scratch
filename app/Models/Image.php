<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  /**
   * @return BelongsTo
   */
  public function post()
  {
    return $this->belongsTo(Post::class);
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
