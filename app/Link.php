<?php

namespace App;

use Storage;

class Link extends AppModel
{
    protected $table = 'links';

    protected $orderBy = 'created_at';

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = [
        'name',         // リンク名
        'type',         // ファイル種別
        'url',          // リンクURL
        'image',        // リンク画像
        'target',       // リンクターゲット
        'description',  // リンク説明
    ];

    public function url()
    {
        return $this->url ?: Storage::url($this->image);;
    }
}
