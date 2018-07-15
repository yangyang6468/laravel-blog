<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfRoleUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_role_user', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('role_id')->unsigned()->default(0)->index('role_id')->comment('角色 id');
			$table->bigInteger('user_id')->unsigned()->default(0)->index('user_id')->comment('用户id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_role_user');
	}

}
