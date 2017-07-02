<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * Comment作成イベントのリッスン
     *
     * @param  Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->hash_ip = $comment->hash();
    }
}
