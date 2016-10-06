<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
use \App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'email' => 'i.s.sergeevich@yandex.ru',
            'password' => Hash::make('florida840905'),
//            'permissions' => null,
            'first_name' => 'Игорь',
            'last_name' => 'Снежко',
            'created_at' => time(),
            'updated_at' => time()
        ]);


    }
}
