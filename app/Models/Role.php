<?php

namespace App\Models;

class Role extends AppModel
{
    protected $table = 'roles';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
