<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use function auth;
use function back;
use function redirect;
use function request;
use function view;

class AdminPostController extends Controller
{
    public function index()
    {
      return view('admin.posts.index', [
        'posts' => Post::paginate(50)
      ]);
    }

  public function create()
  {
    return view('admin.posts.create');
  }

  public function store()
  {
    $attributes = $this->validatePost();

    // add user ID
    $attributes['user_id'] = auth()->id();

    // add thumbnail path
    $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

    Post::create($attributes);

    return redirect('/');
  }

  public function edit(Post $post)
  {
    return view('admin.posts.edit', [
      'post' => $post
    ]);
  }

  public function update(Post $post)
  {
    $attributes = $this->validatePost($post);

    // add thumbnail path
    if (isset($attributes['thumbnail'])) {
      $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
    }

    $post->update($attributes);

    return back()->with('success', 'Post updated');
  }

  public function destroy(Post $post)
  {
    $post->delete();

    return back()->with('success', 'Post deleted');
  }

  /**
   * @param Post|null $post Can be a post or null
   * @return array
   */
  protected function validatePost(?Post $post = null): array
  {
    // if a post isn't passed, instantiate an empty instance
    // assists with thumbnail validation
    $post ??= new Post();

    return request()->validate([
      'title' => 'required',
      'thumbnail' => $post->exists() ? [Rule::imageFile()] : ['required', Rule::imageFile()],
      'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
      'excerpt' => 'required',
      'body' => 'required',
      'category_id' => ['required', Rule::exists('categories', 'id')]
    ]);
  }
}
