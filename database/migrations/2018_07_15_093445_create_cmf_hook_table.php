<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfHookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_hook', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('type')->default(0)->comment('钩子类型(1:系统钩子;2:应用钩子;3:模板钩子;4:后台模板钩子)');
			$table->boolean('once')->default(0)->comment('是否只允许一个插件运行(0:多个;1:一个)');
			$table->string('name', 50)->default('')->comment('钩子名称');
			$table->string('hook', 50)->default('')->comment('钩子');
			$table->string('app', 15)->default('')->comment('应用名(只有应用钩子才用)');
			$table->string('description')->default('')->comment('描述');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_hook');
	}

}
