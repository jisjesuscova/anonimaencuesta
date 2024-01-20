<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministratorPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user)
    {
        return $user->rol_id === 1;
    }
}