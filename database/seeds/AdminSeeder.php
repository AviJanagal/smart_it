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
        $user->name = 'admin';
        $user->email = 'smart_it@gmail.com';
        $user->password = \Hash::make('smart@123');
        $user->role = "admin";
        $user->description = "description";
        $user->save();
    }
}
