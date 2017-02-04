<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
    public function index(User $user)
    {
        return true;
    }

    /**
     * 作成ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * 作成ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * 詳細ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return true;
    }

    /**
     * 更新ページへアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return true;
        // return $user->id === $post->user_id;
    }

    /**
     * 削除へアクセス可能かどうか
     * @param User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->id === $post->user_id;
    }
}
