<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Post;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        // App\Model::class  => Policies\AppPolicy::class,
        // App\Post::class  => Policies\PostPolicy::class,
        // App\User::class  => Policies\UserPolicy::class,
        // App\Image::class => Policies\ImagePolicy::class,
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
