<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TemplateDetails', function(Blueprint $table)
		{
		$table->increments('id');
		$table->Integer('job_id');
		$table->Integer('resource_id');
		$table->string('resource_type');
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
		Schema::table('TemplateDetails', function(Blueprint $table)
		{
			Schema::dropIfExists("TemplateDetails");
		});
	}

}
