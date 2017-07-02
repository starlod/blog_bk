<?php

namespace App\Models;

use cebe\markdown\MarkdownExtra as Markdown;
use App\Models\Comment;
use App\Observers\CommentObserver;

class Comment extends AppModel
{
    protected $table = 'comments';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'post_id',          // 記事ID
        'parent_id',        // 親コメントID
        'author_id',        // 投稿者ID
        'hash_ip',          // ハッシュIP(MD5)
        'name',             // コメント投稿者名
        'content',          // コメント内容
        'email',            // メールアドレス
        'ip',               // IPアドレス
        'approved',         // 承認
        'agent',            // ユーザエージェント
        'type',             // コメント種別
    ];

    public static function boot()
    {
        parent::boot();

        Comment::observe(new CommentObserver);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function parse()
    {
        $parser = new Markdown();

        return $parser->parse($this->content);
    }

    public function hash()
    {
        return hash('md5', $this->ip);
    }
}
