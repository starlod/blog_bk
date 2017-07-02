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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    static $id;

    $id = $id ? $id + 1 : 1;

    return [
        'name' => 'user' . $id,
        'nickname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: 'secret',
        'role_id' => App\Models\Role::all()->random()->id,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    $word = $faker->word;
    return [
        'parent_id'   => null,
        'slug'        => $word,
        'name'        => $word,
        'description' => $faker->text,
        'count'       => 0,
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    $word = $faker->word;
    return [
        'slug'        => $word,
        'name'        => $word,
        'description' => $faker->text,
        'count'       => 0,
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'category_id'  => App\Models\Category::all()->random()->id,
        'title'        => $faker->title,
        'content'      => $faker->content,
        'status'       => $faker->randomElement(config('const.status')),
        'published_at' => $faker->dateTimeBetween('-30 days', $endDate = '30 days'),
        'author_id'    => App\Models\User::all()->random()->id,
        'creator_id'   => App\Models\User::all()->random()->id,
        'updater_id'   => App\Models\User::all()->random()->id,
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id'   => App\Models\Post::all()->random()->id,
        'parent_id' => null,
        'author_id' => App\Models\User::all()->random()->id,
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

// $factory->define(App\Models\Link::class, function (Faker\Generator $faker) {
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
