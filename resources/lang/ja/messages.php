<?php

return [

    'menu' => [
        'login' => 'ログイン',
        'logout' => 'ログアウト',
        'posts_index' => '記事一覧',
        'posts_create' => '記事投稿',
        'images_index' => '画像管理',
        'register' => 'ユーザー登録',
        'dashboard' => 'ダッシュボード',
        'signup' => 'サインアップ',
        'profile' => 'プロフィール',
        'change_password' => 'パスワード変更',
    ],

    'title' => [
        'login' => 'ログイン',
        'register' => 'ユーザー登録',
        'reset_password' => 'パスワードのリセット',
        'dashboard' => 'ダッシュボード',
    ],

    'common' => [
        'created_at' => '作成日',
        'updated_at' => '更新日',
        'remember_me' => 'ログイン情報を記憶する',
        'forgot_your_password' => 'パスワードを忘れた？',
        'welcome' => ':nameさん、ようこそ！',
    ],

    'buttons' => [
        'home'           => 'ホーム',
        'index'          => '一覧',
        'search'         => '検索',
        'show'           => '詳細',
        'edit'           => '編集',
        'create'         => '新規',
        'add'            => '追加',
        'save'           => '保存',
        'register'       => '登録',
        'update'         => '更新',
        'upload'         => 'アップロード',
        'download'       => 'ダウンロード',
        'delete'         => '削除',
        'delete_all'     => '全て削除',
        'back'           => '戻る',
        'back_list'      => '一覧へ戻る',
        'send'           => '送信',
        'answer'         => '回答',
        'login'          => 'ログイン',
        'logout'         => 'ログアウト',
        'clear'          => 'クリア',
        'cancel'         => 'キャンセル',
        'close'          => '閉じる',
        'fix'            => '確定',
        'doing'          => '実施',
        'done'           => '完了',
        'aggregate'      => '集計',
        'unassociate'    => '解除',
        'reset_password' => 'パスワードのリセット',
        'send_password_reset_link' => 'パスワードリセットリンクの送信',
    ],

    'actions' => [
        'index'      => '一覧',
        'search'     => '検索',
        'show'       => '詳細',
        'create'     => '新規登録',
        'edit'       => '編集',
        'login'      => 'ログイン',
        'other'      => 'その他',
    ],

    'user' => 'ユーザー',
    'users' => [
        'name'     => 'ユーザー名',
        'email'    => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'current_password' => '現在のパスワード'
    ],

    'post'  => '記事',
    'posts' => [
        'id'     => 'ID',
        'title'  => 'タイトル',
        'body'   => '内容',
        'author' => '投稿者',
    ],

    'category' => 'カテゴリー',
    'categories' => [
        'id'        => 'ID',
        'parent_id' => '親カテゴリー',
        'slug'      => 'スラッグ',
        'name'      => 'カテゴリー名',
        'count'     => 'カウント',
    ],

    'tag' => 'タグ',
    'tags' => [
        'id'        => 'ID',
        'slug'      => 'スラッグ',
        'name'      => 'タグ名',
        'count'     => 'カウント',
    ],

    'image' => '画像',
    'images' => [
        'id' => 'ID',
        'name' => '画像名',
        'thumbnail' => 'サムネイル',
    ],

    /**
     * 通常 メッセージ
     */
    'no_posts'   => '投稿された記事はありません。',

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
    'not_found'        => ':nameが見つかりませんでした。',
    'already_created'  => 'この:nameはすでに登録済みです。',
    'already_uploaded' => ':nameファイルはすでに登録済みです。',

    /**
     * エラー メッセージ
     */
];
