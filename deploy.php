<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/yarn.php';

// デプロイ設定

set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// 何世代までバックアップを残すか
set('keep_releases', 3);
// Gitリポジトリ設定
set('repository', 'https://starlod@github.com/starlod/blog');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
// 各リリースで共通のファイル
add('shared_files', []);
// 各リリースで共通のディレクトリ
add('shared_dirs', []);
// 書き込み権限を付与するディレクトリ
add('writable_dirs', []);

// Hosts

inventory('hosts.yml');

// Tasks

desc('Build Assets');
task('build:prod', function () {
    run("cd {{release_path}} && {{bin/yarn}} run prod");
});

// Nodejsのライブラリをインストール
after('deploy:update_code', 'yarn:install');
after('yarn:install', 'build:prod');

// デプロイ失敗時にロックを解除
after('deploy:failed', 'deploy:unlock');

// ルートのキャッシュ(routeでクロージャを使用しないこと)
after('artisan:cache:clear', 'artisan:route:cache');

// マイグレート
after('artisan:optimize', 'artisan:migrate');
// シーディング
after('artisan:migrate', 'artisan:db:seed');

// メンテナンスモード
after('deploy:lock', 'artisan:down');
after('deploy:unlock', 'artisan:up');
after('rollback', 'artisan:up');
