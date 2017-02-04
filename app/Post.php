<?php

namespace App;

use Auth;

class Post extends AppModel
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
        'author_id',
        'created_id',
        'updated_id',
    ];

    protected static function boot()
    {
        parent::boot();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
