<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        factory(App\Post::class, 50)->create();

        $posts = App\Post::all();
        foreach ($posts as $post) {
            $post->tags()->attach(App\Tag::all()->random()->id);
            $post->update();
        }
    }
}
