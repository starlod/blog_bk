<?php

namespace App;

use cebe\markdown\MarkdownExtra as Markdown;
use Log;
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
        'content',          // 記事内容
        'status',           // 記事ステータス
        'published_at',     // 公開日時
        'author_id',        // 投稿者ID
        'creator_id',       // 作成者ID
        'updater_id',       // 更新者ID
    ];

    protected $dates = [
        'published_at',     // 公開日時
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

    public function parse()
    {
        $parser = new Markdown();

        return $parser->parse($this->content);
    }

    /**
     * 記事に所属するタグを取得
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * 記事を公開する。
     * @return [type] [description]
     */
    public function publish()
    {
        $this->status = 'PUBLIC';
        $this->save();
        Log::debug('記事を公開しました。', ['id' => $this->id]);
    }
}
