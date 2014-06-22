<?php

class UserTableSeeder extends Seeder{

    public function run(){
        DB::table('users')->delete();

        User::create([
           'username'   => 'alcala',
           'password'  => Hash::make('alcala')
        ]);
    }

} 