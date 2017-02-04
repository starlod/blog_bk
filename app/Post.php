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
        'title',
        'body',
        'author_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->author_id = Auth::user()->id;
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
