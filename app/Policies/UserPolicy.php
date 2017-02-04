<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    /**
     * 一覧ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function profile(User $user)
    {
        return true;
    }

    /**
     * 作成ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function profile(User $user)
    {
        return true;
    }
}
