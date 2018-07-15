<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfOptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_option', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('autoload')->default(1)->comment('是否自动加载;1:自动加载;0:不自动加载');
			$table->string('option_name', 64)->default('')->unique('option_name')->comment('配置名');
			$table->text('option_value')->nullable()->comment('配置值');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_option');
	}

}
