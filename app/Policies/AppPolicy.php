<?php

namespace App\Policies;

use App\User;
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

    public function can_admin($user)
    {
        if ($user->isAdmin()) {
            return true;
        }
        return false;
    }

    public function can_editor($user)
    {
        if ($this->can_admin($user) || $user->isEditor()) {
            return true;
        }
        return false;
    }

    public function can_author($user)
    {
        if ($this->can_editor($user) || $user->isAuthor()) {
            return true;
        }
        return false;
    }

    public function can_contributor($user)
    {
        if ($this->can_author($user) || $user->isContributor()) {
            return true;
        }
        return false;
    }

    public function can_subscriber($user)
    {
        if ($this->can_contributor($user) || $user->isSubscriber()) {
            return true;
        }
        return false;
    }

}
