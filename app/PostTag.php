<?php

namespace App;

class PostTag extends AppModel
{
    protected $table = 'post_tag';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'post_id',      // 記事ID
        'tag_id',       // タグID
    ];
}
