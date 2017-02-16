<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        factory(App\User::class, 1)->create([
            'name'  => '管理者',
            'email' => 'admin@test.jp',
        ]);

        factory(App\User::class, 30)->create();
    }
}
