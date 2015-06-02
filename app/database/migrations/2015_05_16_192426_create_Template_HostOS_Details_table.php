<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateHostOSDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temp_host', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->Integer('resource_id');
			$table->Integer('job_id');
			$table->Integer('os_id');
			$table->Integer('version_id');
			$table->String('architecture');
			$table->String('protocol');
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
		Schema::table('temp_host', function(Blueprint $table)
		{
			Schema::dropIfExists("temp_host");
		});
	}

}
