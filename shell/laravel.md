# Laravel install process

$ cd ~/laravel
$ composer create-project --prefer-dist laravel/laravel ./
$ composer update
$ yarn install
$ yarn upgrade

$ rm README.md
$ echo "# Blog" > README.md
$ git init
$ git add .
$ git commit -m "Laravel Install"
$ git remote add origin https://github.com/starlod/blog.git
$ git push -u origin master

## Laravel 初期設定

$ touch app/Http/helper.php
$ mkdir -p app/Console/Commands
$ touch app/Console/Commands/.gitkeep
$ mkdir -p app/Models
$ touch app/Models/.gitkeep
$ vi composer.json
{
    "autoload": {
        "classmap": [
            "app/Console/Commands",
            "database/migrations",
            "database/seeds"
        ],
        "psr-4": {
            "App\\": "app/"
        },
        "files": ["app/Http/helper.php"]
    },
}

$ composer require barryvdh/laravel-debugbar
$ composer require laravel/dusk
$ composer require laravelcollective/html
$ composer require maknz/slack-laravel

$ mkdir -p app/Providers/Faker
$ cp /vagrant/config/laravel/.editorconfig .editorconfig
$ cp /vagrant/config/laravel/.gitignore .gitignore
$ cp /vagrant/config/laravel/app/Providers/Faker/FakerProvider.php app/Providers/Faker/FakerProvider.php
$ cp /vagrant/config/laravel/app/Providers/DatabaseServiceProvider.php app/Providers/DatabaseServiceProvider.php
$ cp /vagrant/config/laravel/app/Providers/AppServiceProvider.php app/Providers/AppServiceProvider.php
$ sudo cp /vagrant/config/etc/httpd/conf.d/laravel.conf /etc/httpd/conf.d/laravel.conf
$ sudo systemctl restart httpd

$ php artisan dusk:install

$ sed -i 's/webpack.js --watch --progress/webpack.js --watch --watch-poll --progress/' package.json
$ sed -i 's/DB_PORT=3306/DB_PORT=3307/' .env.example
$ sed -i 's/DB_DATABASE=homestead/DB_DATABASE=blog/' .env.example
$ sed -i 's/DB_USERNAME=homestead/DB_USERNAME=blog/' .env.example
$ sed -i 's/DB_PASSWORD=secret/DB_PASSWORD=#aR*bAGZ8T9H/' .env.example
$ cp .env.example .env

$ php artisan key:generate
$ php artisan storage:link

$ vi config/app.php
    'timezone' => 'Asia/Tokyo',
    'locale' => 'ja',
    'faker_locale' => 'ja_JP',
    'fallback_locale' => 'ja',
    'log' => env('APP_LOG', 'daily'),
    'log_max_files' => env('APP_LOG_MAX', 30),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    'providers' => [
        // Illuminate\Database\DatabaseServiceProvider::class,
        App\Providers\DatabaseServiceProvider::class,

        Collective\Html\HtmlServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
    ];

    'aliases' => [
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
    ];

$ open http://blog.dev
