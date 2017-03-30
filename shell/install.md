
# Install process

```
$ vagrant up --no-provision
$ vagrant provision --provision-with install
```

# SSHログインして、インストール作業

```
$ vagrant ssh
```

## MySQL5.7初期パスワード

```
$ cat /var/log/mysqld.log | grep 'temporary password' | awk -F ': ' '{print $NF}'
```

## MySQL初期設定

```
$ mysql_secure_installation
```

## ログイン

```
$ mysql -u root -p#aR*bAGZ8T9H
> show variables like "%character%";
+--------------------------+----------------------------+
| Variable_name            | Value                      |
+--------------------------+----------------------------+
| character_set_client     | utf8                       |
| character_set_connection | utf8                       |
| character_set_database   | utf8                       |
| character_set_filesystem | binary                     |
| character_set_results    | utf8                       |
| character_set_server     | utf8                       |
| character_set_system     | utf8                       |
| character_sets_dir       | /usr/share/mysql/charsets/ |
+--------------------------+----------------------------+
```

> DROP DATABASE IF EXISTS blog;
> CREATE DATABASE blog;
> GRANT ALL PRIVILEGES ON blog.* TO blog@localhost IDENTIFIED BY '#aR*bAGZ8T9H';

## .mylogin.cnf

```
$ mysql_config_editor set --user=blog --password
$ mysql_config_editor set --login-path=mysqldump --user=root --password
$ mysql_config_editor print --all
[client]
user = blog
password = *****
[mysqldump]
user = root
password = *****
```

# Box化

- `Vagrantfile`の共有フォルダの設定を無効化する。
- 不要なファイルを削除してBoxファイルの圧縮を図る。

```
$ vagrant ssh
$ sudo rm -rf /vagrant
$ sudo rm /root/.bash_history
$ sudo rm /home/vagrant/.bash_history
$ sudo yum clean all
$ sudo find /var/log -type f | xargs sudo rm
$ sudo find /tmp -type f | xargs sudo rm
$ sudo dd if=/dev/zero of=/tmp/ZERO bs=4k
$ sudo rm -f /tmp/ZERO
$ history -c
$ exit
```

* 2.5GBのBoxファイルが870MB程度に圧縮される
* すでにboxがあれば念のためバックアップ

```
$ mv package.box package.box.org
$ vagrant package
```

# box 設定ファイルを作成

$ vi package.json
{
    "name": "blog",
    "description": "blog development environment.",
    "short_description": "blog development environment.",
    "versions": [{
        "version": "0.0.1",
        "status": "active",
        "providers": [{
            "name": "virtualbox",
            "url": "package.box"
        }]
    }]
}

# 既にあればbox削除

```
$ vagrant box remove blog -f
$ vagrant destroy -f; rm -rf .vagrant
```

# boxの追加

```
$ vagrant box add blog package.json
$ vagrant up --no-provision
$ open http://blog.dev
```
