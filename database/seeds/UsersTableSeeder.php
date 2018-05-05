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
        $sentinel = app('Cartalyst\Sentinel\Sentinel');

        $sentinel->registerAndActivate([
            'last_name' => 'Nam Vu',
            'email' => 'namvu1210@gmail.com',
            'password' => 'secret',
            'is_superadmin' => true,
        ]);
    }
}
