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
            $name = str_replace('role_', '', strtolower($role->name));
            $user = factory(App\Models\User::class, 1)->create([
                'name'  => $name,
                'email' => $name . '@test.jp',
                'role_id' => $role->id,
            ]);
        }

        factory(App\Models\User::class, 30)->create();
    }
}
