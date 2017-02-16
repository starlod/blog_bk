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

        $roles = App\Role::all();
        foreach ($roles as $key => $role) {
            $user = factory(App\User::class, 1)->create([
                'name'  => "user$key",
                'email' => "user$key@test.jp",
                'role_id' => $role->id,
            ]);
        }

        factory(App\User::class, 30)->create();
    }
}
