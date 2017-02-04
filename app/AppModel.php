<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class AppModel extends Model
{
    public $timestamps = true;

    protected $orderBy;
    protected $orderDirection = 'desc';

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->setCreatedUser();
        });

        static::updating(function($model) {
            $model->setUpdatedUser();
        });
    }

    public function scopeOrdered($query)
    {
        if ($this->orderBy) {
            return $query->orderBy($this->orderBy, $this->orderDirection);
        }
        return $query;
    }

    public function scopeGetOrdered($query)
    {
        return $this->scopeOrdered($query)->get();
    }

    /**
     * 一番古い登録日付を取得（存在しない場合は今日の日付を返す）
     */
    public function scopeFirstCreatedAt($query)
    {
        if ($first = $query->orderBy('created_at', 'asc')->get()->first()) {
            return $first->created_at;
        }

        return new Carbon();
    }

    /**
     * 検索
     * 各モデル内に検索するカラムのスコープを書く。
     */
    public function scopeSearch($query, $keywords)
    {
        foreach ($keywords as $name => $keyword) {
            if ($keyword !== '') {
                $method_name = 'search' . pascal_case($name);
                if (method_exists($this, 'scope' . $method_name)) {
                    $query->$method_name($keyword);
                }
            }
        }
    }

    public function setCreatedUser()
    {
        if (isset($model->created_by_id)) {
            $model->created_by_id = Auth::user()->id;
        }

        $this->setUpdatedUser();
    }

    public function setUpdatedUser()
    {
        if (isset($model->updated_by_id)) {
            $model->updated_by_id = $model->created_by_id;
        }
    }
}
