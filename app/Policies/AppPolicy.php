<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppPolicy
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

    public function before($user, $ability)
    {
        if ($user->isDeveloper()) {
            return true;
        }
    }

    public function canAdmin($user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return false;
    }

    public function canEditor($user)
    {
        if ($this->canAdmin($user) || $user->isEditor()) {
            return true;
        }
        return false;
    }

    public function canAuthor($user)
    {
        if ($this->canEditor($user) || $user->isAuthor()) {
            return true;
        }
        return false;
    }

    public function canContributor($user)
    {
        if ($this->canAuthor($user) || $user->isContributor()) {
            return true;
        }
        return false;
    }

    public function canSubscriber($user)
    {
        if ($this->canContributor($user) || $user->isSubscriber()) {
            return true;
        }
        return false;
    }

}
