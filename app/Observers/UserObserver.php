<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Before creating a user → hash the password.
     */
    public function creating(User $user): void
    {
        //
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Before updating → normalize email format.
     */
    public function updating(User $user): void
    {
        $user->email = strtolower($user->email);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     * After deleting a user → cascade delete related records.
     */
    public function deleted(User $user): void
    {
        // remove related profile
        $user->profile()->delete();

        // detach roles
        $user->roles()->detach();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
