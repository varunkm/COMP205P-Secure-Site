<?php

namespace App\Policies;

use App\User;
use App\Snippet;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function destroy(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user_id;
    }
}
