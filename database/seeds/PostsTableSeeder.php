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

        factory(App\Models\Post::class, 150)->create();

        $posts = App\Models\Post::all();
        foreach ($posts as $post) {
            $post->tags()->attach(App\Models\Tag::all()->random()->id);
            $post->update();
        }
    }
}
