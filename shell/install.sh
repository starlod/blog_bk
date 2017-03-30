#! /bin/sh -x

# yum 設定
cp /etc/yum/pluginconf.d/fastestmirror.conf /etc/yum/pluginconf.d/fastestmirror.conf.org
cat << EOS | sudo tee -a /etc/yum/pluginconf.d/fastestmirror.conf
include_only=.jp
prefer=ftp.iij.ad.jp
EOS

yum -y update
timedatectl set-timezone Asia/Tokyo
localectl set-locale LANG=ja_JP.utf8
setenforce 0
sed -i 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
yum -y groupinstall "Base" "Development tools" "Japanese Support"
yum -y install zip unzip lsof pcre pcre-devel openssl openssl-devel mod_ssl wget curl vim dstat
yum -y install kernel kernel-devel
yum -y install expat-devel libcurl-devel perl-ExtUtils-MakeMaker

# Apache2.4
yum -y install httpd

# PHP7.1
yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
yum -y install --enablerepo=remi-php71 php php-cli php-common php-gd php-xml php-pdo php-mbstring php-mysqlnd php-opcache php-pecl-apcu php-devel php-fpm php-gmp php-intl php-pear php-zip php-xdebug

# MySQL5.7
yum -y localinstall https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
yum -y install mysql-community-server mysql-community-devel

# MySQL5.6
# yum -y localinstall https://dev.mysql.com/get/mysql57-community-release-el7-9.noarch.rpm
# yum -y install yum-utils
# yum-config-manager --disable mysql57-community
# yum-config-manager --enable mysql56-community
# yum -y install mysql-community-server mysql-community-devel

# Ruby2.4.1
yum remove ruby
yum -y install gcc zlib-devel openssl-devel sqlite sqlite-devel mysql-devel readline-devel libffi-devel

wget http://cache.ruby-lang.org/pub/ruby/ruby-2.4.1.zip
unzip ruby-2.4.1.zip
rm -rf ruby-2.4.1.zip
cd ruby-2.4.1
./configure
make
make install

ln -s /usr/local/bin/ruby /usr/bin/ruby
ln -s /usr/local/bin/bundle /usr/bin/bundle
ln -s /usr/local/bin/gem /usr/bin/gem

cd ../
rm -rf ruby-2.4.1

gem update --system
gem update

# ファイアウォール
yum -y install firewalld

# NTP
yum -y install -y chrony
yum -y install -y yum-cron

# Nodejs & yarn
wget https://dl.yarnpkg.com/rpm/yarn.repo -O /etc/yum.repos.d/yarn.repo
curl --silent --location https://rpm.nodesource.com/setup_6.x | bash -
yum -y install nodejs yarn

# Git
yum -y remove git
wget https://www.kernel.org/pub/software/scm/git/git-2.11.1.tar.gz
tar xzvf git-2.11.1.tar.gz
cd git-2.11.1
make configure
./configure --prefix=/usr
make all
make install

cd ../
rm -rf git-2.11.1*

# Composer
yum -y install epel-release
yum -y install composer
ln -s /usr/bin/composer /usr/local/bin

cp /etc/yum/yum-cron.conf /etc/yum/yum-cron.conf.org
cp /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.org
cp /etc/php.ini /etc/php.ini.org
cp /etc/my.cnf /etc/my.cnf.org
cp /etc/chrony.conf /etc/chrony.conf.org

cp /var/www/html/laravel/shell/config/etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf
cp /var/www/html/laravel/shell/config/etc/httpd/conf.d/laravel.conf /etc/httpd/conf.d/laravel.conf
cp /var/www/html/laravel/shell/config/etc/php.ini /etc/php.ini
cp /var/www/html/laravel/shell/config/etc/php.d/xdebug.ini /etc/php.d/xdebug.ini
cp /var/www/html/laravel/shell/config/etc/my.cnf /etc/my.cnf
cp /var/www/html/laravel/shell/config/etc/chrony.conf /etc/chrony.conf

sed -i 's/update_cmd = default/update_cmd = security/' /etc/yum/yum-cron.conf
sed -i 's/apply_updates = no/apply_updates = yes/' /etc/yum/yum-cron.conf

systemctl start yum-cron
systemctl enable yum-cron
systemctl start httpd
systemctl enable httpd
systemctl start mysqld
systemctl enable mysqld
systemctl start firewalld
systemctl enable firewalld
systemctl start chronyd
systemctl enable chronyd

firewall-cmd --add-service=ssh --zone=public --permanent
firewall-cmd --add-service=http --zone=public --permanent
firewall-cmd --reload
firewall-cmd --list-all

# apacheグループにvagrantユーザーを追加
usermod -aG apache vagrant

# プロジェクトルートディレクトリを作成
mkdir -p /var/www/html/laravel
chown apache:apache -R /var/www/html
chmod g+ws -R /var/www/html
ln -s /var/www/html/laravel /home/vagrant/laravel

cat << EOS >> /home/vagrant/.bashrc

umask 002

# ls ファイル一覧表示、容量サイズ表示
alias ll='ls -lh --time-style=long-iso'
# ls ファイル一覧表示、容量サイズ表示、隠しファイル表示
alias la='ls -alh  --time-style=long-iso'

# Laravel
alias test='vendor/bin/phpunit --colors=always'
alias art='php artisan'

# Git
alias gb='git branch'
alias gc='git checkout'
alias gcb='git checkout -b'
alias gs='git status'
alias gcm='git checkout master'
alias gpom='git pull origin master'
alias gmm='git merge master'

EOS

cat << EOS >> /root/.bashrc

# ls ファイル一覧表示、容量サイズ表示
alias ll='ls -lh --time-style=long-iso'
# ls ファイル一覧表示、容量サイズ表示、隠しファイル表示
alias la='ls -alh  --time-style=long-iso'

# Laravel
alias test='vendor/bin/phpunit --colors=always'
alias art='php artisan'

# Git
alias gb='git branch'
alias gc='git checkout'
alias gcb='git checkout -b'
alias gs='git status'
alias gcm='git checkout master'
alias gpom='git pull origin master'
alias gmm='git merge master'

EOS

# タスクスケジューラ
cat << EOS | sudo tee /etc/cron.d/laravel
* * * * * vagrant php /var/www/html/laravel/artisan schedule:run >> /dev/null 2>&1
EOS

# MySQL5.6 初期設定
# mysql -u root <<EOS
# UPDATE mysql.user SET Password = PASSWORD('#aR*bAGZ8T9H') WHERE User = 'root';
# DELETE FROM mysql.user WHERE User='';
# DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
# DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
# DROP DATABASE IF EXISTS test;
# FLUSH PRIVILEGES;

# DROP DATABASE IF EXISTS blog;
# CREATE DATABASE blog;
# GRANT ALL PRIVILEGES ON blog.* TO blog@localhost IDENTIFIED BY '#aR*bAGZ8T9H';
# EOS

# バージョン確認
localectl status
timedatectl
getenforce
cat /etc/redhat-release
git --version
httpd -v
node -v
yarn --version
php -v
composer -V
mysql -V
