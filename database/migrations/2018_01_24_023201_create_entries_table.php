<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entries', function(Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->integer('hour');
            $table->date('pre');
            $table->date('estimated');
            $table->date('accepted');
            $table->date('start');
            $table->date('end');
            $table->date('mainte');
            $table->text('status');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entries');
	}

}
