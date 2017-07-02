<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();

        $posts = App\Models\Post::all();
        foreach ($posts as $post) {
            factory(App\Models\Comment::class, 5)->create([
                'post_id' => $post->id,
            ]);
        }
    }
}
