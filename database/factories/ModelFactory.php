<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    static $id;

    $id = $id ? $id + 1 : 1;

    return [
        'name' => 'user' . $id,
        'nickname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: 'secret',
        'role_id' => App\Role::all()->random()->id,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title'      => $faker->text,
        'body'       => $faker->text,
        'author_id'  => App\User::all()->random()->id,
        'creator_id' => App\User::all()->random()->id,
        'updater_id' => App\User::all()->random()->id,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id'   => App\Post::all()->random()->id,
        'parent_id' => null,
        'author_id' => App\User::all()->random()->id,
        'hash_id'   => $faker->md5,
        'name'      => $faker->name,
        'content'   => $faker->text,
        'email'     => $faker->email,
        'ip'        => $faker->ipv4,
        'approved'  => $faker->randomElement(range(1,3)),
        'agent'     => $faker->userAgent,
        'type'      => $faker->randomElement(range(1,3)),
    ];
});
