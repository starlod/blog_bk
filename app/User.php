<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * ミューテター定義
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * 開発者か
     *
     * @return boolean
     */
    public function is_developer()
    {
        return $this->role->name === config('const.roles')[0];
    }

    /**
     * 管理者か
     *
     * @return boolean
     */
    public function is_admin()
    {
        return $this->role->name === config('const.roles')[1];
    }

    /**
     * 編集者か
     *
     * @return boolean
     */
    public function is_editor()
    {
        return $this->role->name === config('const.roles')[2];
    }

    /**
     * 投稿者か
     *
     * @return boolean
     */
    public function is_author()
    {
        return $this->role->name === config('const.roles')[3];
    }

    /**
     * 寄稿者か
     *
     * @return boolean
     */
    public function is_contributor()
    {
        return $this->role->name === config('const.roles')[4];
    }

    /**
     * 購読者か
     *
     * @return boolean
     */
    public function is_subscriber()
    {
        return $this->role->name === config('const.roles')[5];
    }
}
