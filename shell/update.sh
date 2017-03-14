#! /bin/sh -x

cd /var/www/html/laravel
composer install
yarn install
php artisan migrate
php artisan db:seed
yarn run dev
