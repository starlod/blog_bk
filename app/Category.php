<?php

namespace App;

class Category extends AppModel
{
    protected $table = 'categories';

    protected $orderBy = 'slug';
    protected $orderDirection = 'asc';

    protected $fillable = [
        'parent_id',    // 親カテゴリID
        'slug',         // スラッグ
        'name',         // カテゴリ名
    ];

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }
}
