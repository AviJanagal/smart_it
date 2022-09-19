<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->first_name = 'super';
        $user->last_name = 'admin';
        $user->email = 'smartit@gmail.com';
        $user->password = \Hash::make('smart@123');
        $user->role = "admin";
        $user->phone_number = "1234567890";
        $user->save();
    }
}
