<?php

namespace App\Models;

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
        'type',         // ファイル種別
        'name',         // リンク名
        'url',          // リンクURL
        'path',         // リンク画像パス
        'target',       // リンクターゲット
        'description',  // リンク説明
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->url = Storage::disk('public')->url($model->path);
        });

        static::deleting(function($model) {
            Storage::disk('public')->delete($model->path);
        });
    }

    public function url()
    {
        return $this->url ?: Storage::disk('public')->url($this->path);
    }
}
