<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Role;
use App\User;

class DBInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'table initialization.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->truncate();
        $this->create_roles();
        $this->create_users();
    }

    private function create_roles()
    {
        $roles = config('const.roles');
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }

    private function create_users()
    {
        $roles = config('const.roles');
        $users = [
            [
                'name'    => 'yuki',
                'email'   => 'rgls.ggl@gmail.com',
                'password' => 'secret',
                'role_id' => Role::where(['name' => $roles[ROLE_DEVELOPER]])->first()->id,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }

    private function truncate()
    {
        $tables = ['roles', 'users', 'posts'];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
