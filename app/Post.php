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
        'category_id',      // カテゴリーID
        'title',            // 記事タイトル
        'body',             // 記事内容
        'author_id',        // 投稿者ID
        'creator_id',       // 作成者ID
        'updater_id',       // 更新者ID
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 記事に所属するタグを取得
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
