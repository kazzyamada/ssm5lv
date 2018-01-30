<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        // TestDummy::times(20)->create('App\Post');
        $now = DB::raw('NOW()');

        DB::table('users')->insert([
            'name' => 'guest',
            'email' => 'guest@example.com',
            'password' => bcrypt('password'),
            ]);
    }

}
