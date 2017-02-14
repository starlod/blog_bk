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
        'nickname',
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
     * 関数定義
     */

    /**
     * ユーザー名表示
     */
    public function name()
    {
        return $this->nickname ? $this->nickname : $this->name;
    }

    /**
     * 開発者か
     *
     * @return boolean
     */
    public function isDeveloper()
    {
        return $this->role->name === 'ROLE_DEVELOPER';
    }

    /**
     * 管理者か
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role->name === 'ROLE_ADMINISTRATOR';
    }

    /**
     * 編集者か
     *
     * @return boolean
     */
    public function isEditor()
    {
        return $this->role->name === 'ROLE_EDITOR';
    }

    /**
     * 投稿者か
     *
     * @return boolean
     */
    public function isAuthor()
    {
        return $this->role->name === 'ROLE_AUTHOR';
    }

    /**
     * 寄稿者か
     *
     * @return boolean
     */
    public function isContributor()
    {
        return $this->role->name === 'ROLE_CONTRIBUTOR';
    }

    /**
     * 購読者か
     *
     * @return boolean
     */
    public function isSubscriber()
    {
        return $this->role->name === 'ROLE_SUBSCRIBER';
    }
}
