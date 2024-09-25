<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function updated(User $user)
    {
        $user->updateQuietly(['is_synced' => false]);
    }
}
