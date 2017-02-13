<?php

namespace App;

class Tag extends AppModel
{
    protected $table = 'tags';

    protected $orderBy = 'slug';
    protected $orderDirection = 'asc';

    protected $fillable = [
        'parent_id',    // 親カテゴリID
        'slug',         // スラッグ
        'name',         // カテゴリ名
        'description',  // 説明
        'count',        // カウント
    ];

    /**
     * タグを所有する記事
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
