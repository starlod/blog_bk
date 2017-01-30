<?php
return [
    /**
     * バリデーション メッセージ
     */

    // 職員管理
    'posts' => [
        'role_id.exists'  => '選択された権限は存在しません。',
        'group_id.exists' => '選択されたグループは存在しません。',
    ],

    /**
     * 通常 メッセージ
     */

    /**
     * 成功 メッセージ
     */
    'created'     => ':nameを登録しました。',
    'updated'     => ':nameを更新しました。',
    'deleted'     => ':nameを削除しました。',
    'sent'        => ':nameを送信しました。',

    /**
     * 警告 メッセージ
     */
    'already_created'  => 'この:nameはすでに登録済みです。',
    'already_uploaded' => ':nameファイルはすでに登録済みです。',

    /**
     * エラー メッセージ
     */
];
