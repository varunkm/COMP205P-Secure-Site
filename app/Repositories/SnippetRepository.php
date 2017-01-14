<?php
namespace App\Repositories;

use App\User;
use App\Snippet;
use Illuminate\Support\Facades\DB;

class SnippetRepository
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

  public function getLatestFromEachUser()
  {
    $snippets = Snippet::whereRaw(
      'id in (select max(`id`) from snippets group by `user_id`)'
      )->get();
    return $snippets;
  }
}
