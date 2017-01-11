<?php
namespace App\Repositories;

use App\User;
use App\Snippet;

class UserRepository
{
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function forUser(User $user)
  {
      return Snippet::where('user_id', $user->id)
                  ->orderBy('created_at', 'asc')
                  ->get();
  }

  public function getAll()
  {
    return Snippet::orderBy('created_at', 'asc')
                ->get();
  }
}
