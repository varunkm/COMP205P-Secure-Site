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
    $ids = DB::table('snippets')
        ->select(DB::raw('max(id) as id'))
        ->groupBy('user_id')
        ->get();
    $snippets = Snippet::where('id',($ids[0])->id);
    foreach($ids as $id)
      $snippets->orWhere('id',$id->id);
    return $snippets->get();
  }
}
