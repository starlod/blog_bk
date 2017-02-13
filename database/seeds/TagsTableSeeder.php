<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tag')->truncate();
        DB::table('tags')->truncate();

        $tags = [
            ['slug' => 'php', 'name' => 'PHP'],
            ['slug' => 'centos', 'name' => 'CentOS'],
            ['slug' => 'symfony', 'name' => 'Symfony'],
            ['slug' => 'laravel', 'name' => 'Laravel'],
            ['slug' => 'vue', 'name' => 'Vue'],
        ];

        foreach ($tags as $tag) {
            factory(App\Tag::class, 1)->create([
                'slug' => $tag['slug'],
                'name' => $tag['name'],
                'description' => '',
            ]);
        }
    }
}
