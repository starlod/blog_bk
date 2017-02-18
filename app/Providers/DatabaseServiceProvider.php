<?php

namespace App\Providers;

use Illuminate\Database\DatabaseServiceProvider as BaseDatabaseServiceProvider;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class DatabaseServiceProvider extends BaseDatabaseServiceProvider
{
    /**
     * Register the Eloquent factory instance in the container.
     *
     * @return void
     */
    protected function registerEloquentFactory()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create(config('app.faker_locale'));
        });

        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            $faker->addProvider(new Faker\FakerProvider($faker));

            return EloquentFactory::construct($faker, database_path('factories'));
        });
    }
}
