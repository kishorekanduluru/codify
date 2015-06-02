<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateFilerOSDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temp_filer', function(Blueprint $table)
		{
		$table->increments('id');
			$table->Integer('resource_id');
			$table->Integer('job_id');
			
			$table->String('mode');
			
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
		//
		Schema::table('temp_filer', function(Blueprint $table)
		{
			Schema::dropIfExists("temp_filer");
		});
	}

}
