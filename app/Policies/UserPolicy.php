<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    const UPDATE = 'update';

    public function update(User $user, User $auth)
    {
        return $auth->id === $user->id;
    }
}
