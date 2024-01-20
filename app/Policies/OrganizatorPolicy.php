<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizatorPolicy
{
    use HandlesAuthorization;

    public function isOrganizator(User $user)
    {
        return $user->rol_id === 2;
    }
}
