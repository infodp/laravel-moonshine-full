<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Team;
use MoonShine\Models\MoonshineUser;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Team $item): bool
    {
        return $user->isSuperUser();
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->isSuperUser();
    }

    public function update(MoonshineUser $user, Team $item): bool
    {
        return true;
    }

    public function delete(MoonshineUser $user, Team $item): bool
    {
        return $user->isSuperUser();
    }

    public function restore(MoonshineUser $user, Team $item): bool
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Team $item): bool
    {
        return true;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
