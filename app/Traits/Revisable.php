<?php

namespace App\Traits;

use App\Models\Revision;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Revisable
{
  /** Revise a model. Note: `$this` is the model
   * @param User|null $userId User ID
   * @return void
   */
  public function revise(User $userId = null): void
  {
    $user = $userId ?: Auth::id();

    // create the revision
    $revision = new Revision([
      'user_id' => $user,
      ...$this->getDiff(),
    ]);
    $revision->save();

    // add the revision to the model
    $this->revisions()->attach($revision);
  }

  /**
   * Compute the diff between the original and changed model
   * @return array
   */
  protected function getDiff(): array
  {
    $original = $this->fresh()->toArray(); // gets the original post model
    $changes = $this->getDirty(); // gets the changes to the posts

    return [
      'before' => json_encode(array_intersect_key($original, $changes)),
      'after' => json_encode($changes),
    ];
  }
}
