<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
use \App\User;
use \App\Role;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->truncate();

        $role = Role::where('name', '=', 'admin')->first();

        $admin = User::create([
            'id' => 1,
            'email' => 'i.s.sergeevich@yandex.ru',
            'password' => Hash::make('snezhko'),
//            'permissions' => null,
            'first_name' => 'Игорь',
            'last_name' => 'Снежко',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $admin->attachRole($role);
    }
}
