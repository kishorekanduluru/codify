<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('template', function(Blueprint $table)
		{
		$table->increments('id');
		$table->Integer('template_id');
		$table->Integer('job_id');
		$table->string('job_name');
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
		Schema::table('template', function(Blueprint $table)
		{
			Schema::dropIfExists("template");
		});
	}

}
