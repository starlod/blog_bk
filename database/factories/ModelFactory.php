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

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $word = $faker->word;
    return [
        'parent_id'   => null,
        'slug'        => $word,
        'name'        => $word,
        'description' => $faker->text,
        'count'       => 0,
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $word = $faker->word;
    return [
        'slug'        => $word,
        'name'        => $word,
        'description' => $faker->text,
        'count'       => 0,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'category_id'  => App\Category::all()->random()->id,
        'title'        => $faker->title,
        'body'         => $faker->title,
        'status'       => $faker->randomElement(config('const.status')),
        'published_at' => $faker->dateTimeBetween('-30 days', $endDate = '30 days'),
        'author_id'    => App\User::all()->random()->id,
        'creator_id'   => App\User::all()->random()->id,
        'updater_id'   => App\User::all()->random()->id,
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

// $factory->define(App\Link::class, function (Faker\Generator $faker) {
//     $url = $faker->imageUrl(640, 480);
//     return [
//         'name'        => $faker->word,
//         'type'        => 0,
//         'url'         => $url,
//         'path'        => $url,
//         'target'      => $url,
//         'description' => $faker->text,
//     ];
// });
