<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfAdminMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_admin_menu', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0)->index('parent_id')->comment('父菜单id');
			$table->boolean('type')->default(1)->comment('菜单类型;1:有界面可访问菜单,2:无界面可访问菜单,0:只作为菜单');
			$table->boolean('status')->default(0)->index('status')->comment('状态;1:显示,0:不显示');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('app', 40)->default('')->comment('应用名');
			$table->string('controller', 30)->default('')->index('controller')->comment('控制器名');
			$table->string('action', 30)->default('')->comment('操作名称');
			$table->string('param', 50)->default('')->comment('额外参数');
			$table->string('name', 30)->default('')->comment('菜单名称');
			$table->string('icon', 20)->default('')->comment('菜单图标');
			$table->string('remark')->default('')->comment('备注');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_admin_menu');
	}

}
