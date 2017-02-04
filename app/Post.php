<?php

namespace App;

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
        'created_by_id',
        'updated_by_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
