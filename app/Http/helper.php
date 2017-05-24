<?php

/**
 * アセットにバージョン情報を付加
 */
function asset_ver($path)
{
    if (file_exists(public_path() . '/' . $path)) {
        return asset($path) . '?ver=' . date('YmdHis', filemtime(public_path() . '/' . $path));
    }

    return asset($path) . '?ver=' . env('APP_VER', '0.0.1');
}

/**
 *
 */
function active($slug, $type = 'nav')
{
    if ($type === 'nav') {
        return Request::url() === url($slug) ? 'active' : '';
    }
    return '';
}

/**
 * X秒前、X分前、X時間前、X日前などといった表示に変換する。
 * 一分未満は秒、一時間未満は分、一日未満は時間、
 * 31日以内はX日前、それ以上はX月X日と返す。
 * X月X日表記の時、年が異なる場合はyyyy年m月d日と、年も表示する
 *
 * @param   string $date     strtotime()で変換できる時間文字列 (例：yyyy/mm/dd H:i:s)
 * @return  string           X日前,などといった文字列
 */
function fuzzy_time($date)
{
    $unix = time();
    if (gettype($date) === 'string') {
        $unix = strtotime($date);
    } elseif (gettype($date) === 'object') {
        if (get_class($date) === 'DateTime') {
            $unix = strtotime($date->format('Y-m-d H:i:s'));
        } elseif (get_class($date) === 'Carbon\Carbon') {
            $unix = strtotime($date->format('Y-m-d H:i:s'));
        }
    }
    $now      = time();
    $diff_sec = $now - $unix;
    if ($diff_sec < 60) {
        $time = $diff_sec;
        $unit = "秒前";
    } elseif ($diff_sec < 3600) {
        $time = $diff_sec / 60;
        $unit = "分前";
    } elseif ($diff_sec < 86400) {
        $time = $diff_sec / 3600;
        $unit = "時間前";
    } elseif ($diff_sec < 2764800) {
        $time = $diff_sec / 86400;
        $unit = "日前";
    } else {
        if (date("Y") != date("Y", $unix)) {
            $time = date("Y年n月j日", $unix);
        } else {
            $time = date("n月j日", $unix);
        }
        return $time;
    }
    return (int)$time . $unit;
}

/**
 * UNIX時間から日付文字列に変換
 * @param dateUnix = 1171502725
 * @return String
 */
function to_date_string($dateUnix, $format = 'Y-m-d H:i:s')
{
    return date($format, intval($dateUnix));
}

/**
 * 日付文字列からUNIX時間に変換
 * @param dateStr = '2012/04/18 15:55:53'
 * @return Int
 */
function to_unix_time($dateStr)
{
    return strtotime($dateStr);
}

/**
 * ファイル名から拡張子を取得する関数
 */
function get_extension($filename, $lower = true)
{
    if ($lower) {
        return mb_strtolower(mb_substr($filename, mb_strrpos($filename, '.') + 1));
    } else {
        return mb_strtoupper(mb_substr($filename, mb_strrpos($filename, '.') + 1));
    }
}

/**
 * 配列の最初のkey値を取得する（連想配列にも対応）
 */
function get_first_key(Array $array)
{
    return key(array_slice($array, 0, 1, true));
}

/**
 * 配列の最後のkey値を取得する（連想配列にも対応）
 */
function get_last_key(Array $array)
{
    return key(array_slice($array, -1, 1, true));
}

/**
 * 時：分を渡して分（数値）を返す
 */
function get_minute_serial($timeString = '00:00')
{
    $time = 0;
    if ($timeString) {
        $timeArray = explode(':', $timeString);
        $time = $timeArray[0] * 60 + $timeArray[1];
    }
    return $time;
}

/**
 * 分（数値）渡して時：分の文字列を返す
 */
function get_hour_minute($time = 0)
{
    $timeString = '';
    // 時間を文字列に変換（マイナス値は処理しない）
    if ($time > 0) {
        $hour = $time / 60;
        $minute = $time % 60;
        $timeString = sprintf('%02d', $hour) . ':' . sprintf('%02d', $minute);
    }
    return $timeString;
}

/**
 * 年度表示
 * @param DateTime $date
 * @return string
 */
function get_fiscal_year($date)
{
    return (new \DateTime('-3 month'))->format('Y');
}

/**
 *
 * @param string $column 英カラム名
 * @param string $value データの値
 * @return string
 */
function trans_model($column, $value = null)
{
    $str = 'model.' . $column;
    if ($value !== null) {
        $str .= '.' . $value;
    }
    if (is_array(trans($str))) {
        return '';
    }
    return trans($str);
}

/**
 * 日付文字列を変換
 *
 * @param string $date_str 日付文字列
 * @param string $from 変換前の日付フォーマット
 * @param string $to  変換後の日付フォーマット
 * @return string
 */
function convert_datetime($date_str, $from = 'Ymd', $to = 'Y年n月j日')
{
    return \DateTime::createFromFormat($from, $date_str)->format($to);
}

/**
 * パスカルケースに変換
 * @param string $str
 */
function pascal_case($str)
{
    return strtr(ucwords(strtr($str, ['_' => ' '])), [' ' => '']);
}

/**
 * 曜日を日本語に変換する
 *
 * @param int $idx 曜日番号
 * @return string
 */
function trans_weekdays($idx)
{
    $str = '';
    if ($idx >= 0 && $idx <= 6) {
        $str = trans('common.weekdays.' . $idx);
    }
    return $str;
}

/**
 * 指定範囲の日付の配列を取得
 *
 * @param   \Carbon\Carbon $start
 * @param   \Carbon\Carbon $end
 * @param   string $format
 * @return  array
 */
function get_period($start, $end, $format = 'Y-m-d')
{
    $start = $start->copy();
    $dates = [];
    while ($start->lte($end)) {
        $dates[] = $start->format($format);
        $start->addMonth();
    }
    return $dates;
}

/**
 * 和暦変換
 *
 * @param string | \DateTime | \Carbon\Carbon $date
 * @param string $to_format = 'JK年' => '平成28年'
     * J : 元号
     * b : 元号略称
     * K : 和暦年(1年を元年と表記)
     * k : 和暦年
     * x : 日本語曜日(0:日-6:土)
     * E : 午前午後
     * DateTimeの通常のformatも使用できる
 * @param string $from_format = 'Y' => '2016'
 */
function to_wareki($date, $to_format = 'JK年', $from_format = 'Y-m-d')
{
    if (gettype($date) === 'string') {
        $dt = date_create_from_format($from_format, $date);
        return to_wareki($dt, $to_format, $from_format);
    } elseif (gettype($date) === 'integer') {
        // 2016 などの年数が来ることを想定
        $dt = date_create_from_format('Y', $date);
        return to_wareki($dt, $to_format, $from_format);
    } elseif (gettype($date) === 'object') {
        if (get_class($date) === 'DateTime') {
            $dt = new App\DateTimeJp($date->format($from_format));
        } elseif (get_class($date) === 'Carbon\Carbon') {
            $dt = new App\DateTimeJp($date->format($from_format));
        } else {
            abort(503);
        }
    } else {
        // その他の場合は現在の日付を設定
        $dt = new \Carbon\Carbon();
        return to_wareki($dt, $to_format, $from_format);
    }
    return $dt->format($to_format);
}

/**
 * 年度変換
 *
 * @param string | \DateTime | \Carbon\Carbon $date
 * @param string $to_format = 'JK年' => '平成28年'
 * @param string $from_format = 'Y' => '2016'
 */
function to_nendo($date, $to_format = 'JK年度', $from_format = 'Y-m-d')
{
    if (gettype($date) === 'string') {
        $dt = date_create_from_format($from_format, $date);
        return to_nendo($dt, $to_format, $from_format);
    } elseif (gettype($date) === 'integer') {
        // 2016 などの年数が来ることを想定
        $dt = date_create_from_format($from_format, $date . '-04-02');
        return to_nendo($dt, $to_format, $from_format);
    } elseif (gettype($date) === 'object') {
        if (get_class($date) === 'DateTime') {
            $dt = new \Carbon\Carbon($date->format($from_format));
        } elseif (get_class($date) === 'Carbon\Carbon') {
            $dt = new \Carbon\Carbon($date->format($from_format));
        } else {
            abort(503);
        }
    } else {
        // その他の場合は現在の日付を設定
        $dt = new \Carbon\Carbon();
        return to_nendo($dt, $to_format, $from_format);
    }
    // 4月2日以降が新年度とする。(4/1までは前年度)
    return to_wareki($dt ? $dt->copy()->modify('-3 months -1 days') : null, $to_format, $from_format);
}

/**
 * 年度変換
 *
 * @param string | \DateTime | \Carbon\Carbon $date
 */
function to_nendo_full($date)
{
    return to_nendo($date, 'JK年度') . to_wareki($date, 'n月j日');
}

/**
 * 年度変換
 *
 * @param string | \DateTime | \Carbon\Carbon $date
 */
function to_nendo_month($date)
{
    return to_nendo($date, 'JK年度') . to_wareki($date, 'n月');
}

/**
 * 年度変換
 *
 * @param string | \DateTime | \Carbon\Carbon $date
 */
function to_nendo_minute($date)
{
    return to_nendo($date, 'JK年度') . to_wareki($date, 'n月j日H時i分', 'Y-m-d H:i');
}

/**
 * [年 => 年]の配列を返す
 * [年 => 年度]の配列を返す
 * [年 => 年（年度）]の配列を返す
 *
 * @param int $min_year
 * @param int $max_year
 * @param array parameters
 * @return array
 */
function years($min_year, $max_year = null, $parameters = [])
{
    // オプション
    extract(collect([
        'format'   => 'Y（JK年度）', // 日付フォーマット(to_wareki参照)
        'add_year' => 1,           // 加算する年数
        'is_asc'   => false,       // 並び順（デフォルト: 降順）
        'is_blank' => false,       // 空の要素を作成するか
    ])->merge($parameters)->toArray());
    if (!$min_year) {
        $min_year = date('Y');
    }
    if (!$max_year) {
        $max_year = date('Y');
    }
    // 年数を加算
    $max_year  += $add_year;
    // 開始年の設定
    $start_year = $is_asc === true ? $min_year : $max_year;
    // 終了年の設定
    $end_year   = $is_asc === true ? $max_year : $min_year;
    // 空オプションの設定
    $years = $is_blank ? ['' => ''] : [];
    // 年の配列を生成
    foreach (range($start_year, $end_year) as $year) {
        $years[$year] = to_wareki($year, $format);
    }
    return $years;
}

/**
 * [model.column => 日本語]の配列を返す
 *
 * @param array models
 * @return array
 */
function table_lang($models)
{
    $array = [];
    foreach ($models as $model) {
        $table = $model->getTable();
        $columns = trans('model.' . $table);
        foreach ($columns as $key => $value) {
            $array[$table . '.' . $key] = $value;
        }
    }
    return $array;
}

/**
 * ファイルのバージョニングをする
 */
function versioning($filename)
{
    if (file_exists(public_path() . '/' . $filename)) {
        return '?ver=' . date('YmdHis', filemtime(public_path() . '/' . $filename));
    }
    return '';
}

/**
 * 改行テキストを配列に変換する
 */
function text_to_array($text)
{
    $array = preg_split('/\r\n|\r|\n/' , $text);    // とりあえず行に分割
    $array = array_map('trim', $array);             // 各行にtrim()をかける
    $array = array_filter($array, 'strlen');        // 文字数が0の行を取り除く
    $array = array_values($array);                  // これはキーを連番に振りなおしてるだけ
    return $array;
}

/**
 * 改行テキストをcollectに変換する
 */
function text_to_collect($text)
{
    return collect(text_to_array($text));
}

/**
 * 配列を改行テキストに変換する
 */
function array_to_text($array)
{
    return implode("\r\n", $array);
}

/**
 * ファイルサイズの単位変換
 *
 * @param int $byte
 * @return string
 */
function file_size($byte)
{
    if ($byte < 1024) {
        return $byte . ' B';
    } else if ($byte < 1048576) {
        return number_format($byte / 1024, 2) . ' KB';
    } else if ($byte < 1073741824) {
        return number_format($byte / 1048576, 2) . ' MB';
    } else if ($byte < 1099511627776) {
        return number_format($byte / 1073741824, 2) . ' GB';
    } else {
        return number_format($byte / 1099511627776, 2) . ' TB';
    }
}

/**
 * ログ
 *
 */
function logging($message, $level = 'debug')
{
    $user = auth()->user();
    $user_id = $user ? $user->id : '';
    $user_name = $user ? $user->name : 'guest';
    $uri = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
    \Log::$level($message, compact('user_id', 'user_name', 'uri', 'user_agent', 'referer'));
}

/**
 * フラッシュメッセージを表示
 *
 * @param string $message フラッシュメッセージに表示する内容
 * @param string $alert ログレベル、Bootstrapのアラートクラス名（alert-***）
    * info
    * success
    * warning
    * danger
 * @param string $attributes $messageのプレースホルダーを置き換え
 * @param boolean $overwrite フラッシュメッセージを上書きするか
 */
function message($message, $alert = 'info', $attributes = [], $overwrite = false)
{
    $trans = trans($message, $attributes);
    $level = config("const.alerts.$alert");
    logging($message, $level);
    if ($overwrite) {
        \Session::forget('messages.' . $alert);
    }
    \Session::push('messages.' . $alert, $trans);
}
