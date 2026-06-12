<?php

namespace App\Observers;

use App\Models\User;
use App\CreateProfileTrait;
class UserObserver
{
    use CreateProfileTrait;
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
       // $this->create_profile($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if($user->isDirty('verify') && $user->verfiy){
            $this->restore_profile($user);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
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
