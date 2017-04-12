# README

## 準備

```
$ VBoxManage -v
5.1.16r113841

$ vagrant -v
Vagrant 1.9.2

$ vagrant plugin list
vagrant-hostsupdater (1.0.2)
  - Version Constraint: > 0
vagrant-share (1.1.7)
  - Version Constraint: > 0
vagrant-vbguest (0.13.0)
  - Version Constraint: > 0

* 足りないものはインストールしてください。
$ vagrant plugin install vagrant-hostsupdater
$ vagrant plugin install vagrant-share
$ vagrant plugin install vagrant-vbguest
```

### /etc/hosts ファイルに書き込み権限を付与

```
$ sudo chmod 777 /etc/hosts
```

- `vagrant-hostsupdater` が起動時、終了時に書き込むため権限を付与します。

## 初回起動時

```
$ git clone https://github.com/starlod/blog
$ cd blog
$ vagrant up --no-provision
$ vagrant provision --provision-with bootstrap
$ open http://blog.dev
```

## 2回目以降

```
$ vagrant up
$ open http://blog.dev
```

## コマンド

```
* SSH接続
$ vagrant ssh

* 開発ビルド
$ yarn run dev
* 開発ビルド（監視モード）
$ yarn run watch
* 本番ビルド（圧縮）
$ yarn run production
```

## パッケージ、データベースの更新

```
$ vagrant provision --provision-with update
```

または

```
$ vagrant ssh
$ cd laravel
$ composer install
$ yarn install
$ php artisan migrate
$ php artisan db:seed
$ yarn run dev
```

## 環境

