<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Log;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ALERT_INFO    = 'info';         // 通常メッセージ
    const ALERT_SUCCESS = 'success';      // 成功メッセージ
    const ALERT_WARNING = 'warning';      // 警告メッセージ
    const ALERT_DANGER  = 'danger';       // エラーメッセージ

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    private function log($message, $type = 'debug', $overwrite = false)
    {
        $user = \Auth::user();
        $user_id = $user ? $user->id : '';
        $user_name = $user ? $user->name() : 'guest';
        $uri = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';
        Log::$type($message, compact('user_id', 'user_name', 'uri', 'user_agent', 'referer'));
    }

    /**
     * フラッシュメッセージを表示する
     *
     * @param message フラッシュメッセージに表示する内容
     * @param class Bootstrapのアラートクラス名（alert-***）
     * @param overwrite フラッシュメッセージを上書きするか
     */
    private function message($message, $class = self::ALERT_INFO, $overwrite = false)
    {
        if ($overwrite) {
            Session::forget('messages.' . $class);
        }
        Session::push('messages.' . $class, $message);
    }

    /**
     * フラッシュメッセージを表示する（通常）
     *
     * @param message    フラッシュメッセージに表示する内容
     * @param attributes フラッシュメッセージに表示する内容
     */
    public function info($message, $attributes = [], $overwrite = false)
    {
        $message = trans($message, $attributes);
        $this->log($message, 'info');
        $this->message($message, self::ALERT_INFO, $overwrite);
    }

    /**
     * フラッシュメッセージを表示する（成功）
     *
     * @param message    フラッシュメッセージに表示する内容
     * @param attributes フラッシュメッセージに表示する内容
     */
    public function success($message, $attributes = [], $overwrite = false)
    {
        $message = trans($message, $attributes);
        $this->log($message, 'info');
        $this->message($message, self::ALERT_SUCCESS, $overwrite);
    }

    /**
     * フラッシュメッセージを表示する（警告）
     *
     * @param message    フラッシュメッセージに表示する内容
     * @param attributes フラッシュメッセージに表示する内容
     */
    public function warning($message, $attributes = [], $overwrite = false)
    {
        $message = trans($message, $attributes);
        $this->log($message, 'warning');
        $this->message($message, self::ALERT_WARNING, $overwrite);
    }

    /**
     * フラッシュメッセージを表示する（エラー）
     *
     * @param message    フラッシュメッセージに表示する内容
     * @param attributes フラッシュメッセージに表示する内容
     */
    public function error($message, $attributes = [], $overwrite = false)
    {
        $message = trans($message, $attributes);
        $this->log($message, 'error');
        $this->message($message, self::ALERT_DANGER, $overwrite);
    }
}
