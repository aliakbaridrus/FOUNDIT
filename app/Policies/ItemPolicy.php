<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;

class ItemPolicy
{
    public function delete(User $user, Item $item): bool
    {
        return $user->isAdmin() || $user->id === $item->user_id;
    }
}
