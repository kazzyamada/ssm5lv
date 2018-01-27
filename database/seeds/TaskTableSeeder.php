<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class TaskTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $now = DB::raw('NOW()');

        DB::table('tasks')->insert([
            'id' => 1,
            'entries_id' => 1,
            'log' => 'log1',
            'created_at' => $now,
            'updated_at' => $now,
            ]);
        DB::table('tasks')->insert([
            'id' => 2,
            'entries_id' => 2,
            'log' => 'log2',
            'created_at' => $now,
            'updated_at' => $now,
            ]);

    }

}
