<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_role', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0)->index('parent_id')->comment('父角色ID');
			$table->boolean('status')->default(0)->index('status')->comment('状态;0:禁用;1:正常');
			$table->integer('create_time')->unsigned()->default(0)->comment('创建时间');
			$table->integer('update_time')->unsigned()->default(0)->comment('更新时间');
			$table->float('list_order', 10, 0)->default(0)->comment('排序');
			$table->string('name', 20)->default('')->comment('角色名称');
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
		Schema::drop('cmf_role');
	}

}
