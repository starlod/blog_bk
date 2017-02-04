<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $roles = config('const.roles');
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}
