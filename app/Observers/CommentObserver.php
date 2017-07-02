<?php

namespace App\Observers;

use Illuminate\Http\Request;
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
        $comment->ip      = $comment->ip ?: request()->ip();
        $comment->agent   = $comment->agent ?: request()->header('User-Agent');
        $comment->hash_ip = $comment->hash();
    }
}
