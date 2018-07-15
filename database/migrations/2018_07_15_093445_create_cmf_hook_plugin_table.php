<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfHookPluginTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_hook_plugin', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->boolean('status')->default(1)->comment('状态(0:禁用,1:启用)');
			$table->string('hook', 50)->default('')->comment('钩子名');
			$table->string('plugin', 50)->default('')->comment('插件');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_hook_plugin');
	}

}
