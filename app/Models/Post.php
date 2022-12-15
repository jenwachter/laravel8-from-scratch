<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
  use HasFactory;

  // disables mass-assignment -- good to use for actual projects
  // protected $fillable = [];

  protected $guarded = ['id'];

  protected $with = ['author', 'category', 'thumbnail'];

  // relationships: hasOne, hasMany, belongsTo, belongsToMany
  public function revisions()
  {
    return $this->morphToMany(Revision::class, 'revisable')->withTimestamps();
  }

  /**
   * Adds a `category` property to posts
   * @return BelongsTo
   */
  public function category()
  {
    // don't need to specify column name because laravel assumes `category_id`
    return $this->belongsTo(Category::class);
  }

  /**
   * Adds a `comments` property to posts
   * @return HasMany
   */
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  /**
   * Adds an `author` property to posts
   * @return BelongsTo
   */
  public function author()
  {
    // need to specify column name because laravel assumes `author_id`
    return $this->belongsTo(User::class, 'user_id');
  }

  public function thumbnail()
  {
    return $this->hasOne(Image::class, 'id', 'thumbnail_id');
  }

  public function hero()
  {
    return $this->hasOne(Image::class, 'id', 'hero_id');
  }

  /**
   * Scope a query to only include posts that match the search and/or
   * category and/or author query string parameter(s)
   *
   * @param Builder $query
   * @return Builder
   */
  public function scopeFilter($query, array $filters = [])
  {
    // adds additional clauses to the query when there is a `search` query string param
    $query->when($filters['search'] ?? false, fn($query, $search) =>
      $query->where(fn($query) =>
        // groups this where together
        $query
          ->where('title', 'like', "%{$search}%")
          ->where('excerpt', 'like', "%{$search}%")
          ->orWhere('body', 'like', "%{$search}%")));

    // adds additional clauses to the query when there is a `category` query string param
    $query->when($filters['category'] ?? false, fn($query, $category) =>
      $query->whereHas('category', fn($query) =>
        $query->where('slug', $category)));

    // adds additional clauses to the query when there is a `author` query string param
    $query->when($filters['author'] ?? false, fn($query, $author) =>
      $query->whereHas('author', fn($query) =>
        $query->where('username', $author)));

    return $query;
  }
}
