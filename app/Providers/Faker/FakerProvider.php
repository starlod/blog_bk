<?php

namespace App\Providers\Faker;

use Faker\Provider\Base;

class FakerProvider extends Base
{
    protected static $titles = [
        'サーバル', 'うわーーー！', 'うぇひひひひ', 'いひひひ', 'あははは', 'あははは', 'うぃひひひひ', 'あーはー！', 'うぉー！', 'かばん', 'うわー！',
        'うわー！！', 'サーバル', 'わーい！', 'かばん', 'どこここ？', 'なんでぇ？', 'サーバル', 'かりごっこだね！', 'まけないんだから！', 'ミャー、ミャー、ミャー！',
        'やさしー！', 'たーのしー！', 'すごーい！', 'あれー？', 'そんなことないよー！', 'おいしー！', 'えっへん！', 'キミもフレンズなんだね！', 'キミはどんなフレンズないの？',
        'すっごーい', 'うーん？'
    ];

    public static function title()
    {
        return static::randomElement(static::$titles);
    }
}
