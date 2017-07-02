<?php

namespace App\Models;

class Category extends AppModel
{
    protected $table = 'categories';

    protected $orderBy = 'slug';
    protected $orderDirection = 'asc';

    protected $fillable = [
        'parent_id',    // 親カテゴリID
        'slug',         // スラッグ
        'name',         // カテゴリ名
        'description',  // 説明
        'count',        // カウント
    ];

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function count()
    {
        return Post::where('category_id', $this->id)->get()->count();
    }
}
