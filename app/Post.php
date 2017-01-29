<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
    ];
}
