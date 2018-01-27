<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EntryTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $now = DB::raw('NOW()');

        DB::table('entries')->insert([
            'id' => 1,
            'title' => 'title1',
            'created_at' => $now,
            'updated_at' => $now,
            ]);
        DB::table('entries')->insert([
            'id' => 2,
            'title' => 'title2',
            'created_at' => $now,
            'updated_at' => $now,
            ]);
    }

}
