<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job', function(Blueprint $table)
		{
			//
			$table->increments('id');
		    $table->String('job_name');
			$table->enum('status', array('running', 'aborted','finished','queued'));
			$table->integer('user_id');
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
		Schema::table('job', function(Blueprint $table)
		{
			Schema::dropIfExists("job");
		});
	}

}
