<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Player;
use MoonShine\Models\MoonshineUser;

class PlayerPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Player $item): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Player $item): bool
    {
        return true;
    }

    public function delete(MoonshineUser $user, Player $item): bool
    {
        return true;
    }

    public function restore(MoonshineUser $user, Player $item): bool
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Player $item): bool
    {
        return true;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
