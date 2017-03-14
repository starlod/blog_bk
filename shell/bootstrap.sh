#! /bin/sh -x

yum -y update
cd /var/www/html/laravel
composer install
yarn install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
yarn run dev

systemctl restart network
systemctl restart httpd
