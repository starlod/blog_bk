<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            ['slug' => 'technology', 'name' => '技術', 'childs' => [
                ['slug' => 'development-environment', 'name' => '環境構築'],
                ['slug' => 'front-end', 'name' => 'クライアントサイド'],
                ['slug' => 'back-end', 'name' => 'サーバーサイド'],
                ['slug' => 'issue', 'name' => 'イシュー'],
            ]],
            ['slug' => 'diary', 'name' => '日記'],
            ['slug' => 'notice', 'name' => 'お知らせ'],
        ];

        $this->recursion($categories);
    }

    private function recursion($models, $options = ['parent_id' => null])
    {
        foreach ((array)$models as $model) {
            $data = collect($model);
            $childs = $data->pull('childs');
            $category = App\Models\Category::create($data->merge($options)->all());
            $this->recursion($childs, ['parent_id' => $category->id]);
        }
    }
}
