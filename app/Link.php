<?php

namespace App;

class Link extends AppModel
{
    protected $table = 'links';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'name',         // リンク名
        'url',          // リンクURL
        'image',        // リンク画像
        'target',       // リンクターゲット
        'description',  // リンク説明
    ];
}
