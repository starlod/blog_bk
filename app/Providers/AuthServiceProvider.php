<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Models\Model::class => App\Policies\AppPolicy::class,
        App\Models\Post::class  => App\Policies\PostPolicy::class,
        // App\Models\User::class  => Policies\UserPolicy::class,
        // App\Models\Image::class => Policies\ImagePolicy::class,
        // Controllers\PostController::class  => Policies\PostPolicy::class,
        // 'App\Http\Controllers\PostController' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
