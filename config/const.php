<?php

return [
    'alerts' => [
        // アラートクラス => ログレベル
        'info'    => 'info',
        'success' => 'info',
        'warning' => 'warning',
        'danger'  => 'warning',
    ],
    'roles' => [
        0 => 'ROLE_DEVELOPER',
        1 => 'ROLE_ADMINISTRATOR',
        2 => 'ROLE_EDITOR',
        3 => 'ROLE_AUTHOR',
        4 => 'ROLE_CONTRIBUTOR',
        5 => 'ROLE_SUBSCRIBER',
    ],
    'status' => [
        0 => 'PUBLISH',       // 公開済み
        1 => 'PENDING',       // 保留
        2 => 'DRAFT',         // 下書き
        3 => 'PRIVATE',       // プライベート（非公開）
        4 => 'FUTURE',        // 予約投稿
    ],
];
