<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfNavTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_nav', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('parent_id')->comment('父 id');
			$table->boolean('status')->default(1)->comment('状态;1:显示;0:隐藏');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('name', 50)->default('')->comment('菜单名称');
			$table->string('target', 10)->default('')->comment('打开方式');
			$table->string('href', 100)->default('')->comment('链接');
			$table->string('path')->default('')->comment('层级关系');
			$table->boolean('flag')->default(0)->comment('导航类型 0 头部导航 1 友情链接');
			$table->boolean('isdelete')->default(0)->comment('是否删除');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_nav');
	}

}
