<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserLoginAttemptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_login_attempt', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('login_attempts')->unsigned()->default(0)->comment('尝试次数');
			$table->integer('attempt_time')->unsigned()->default(0)->comment('尝试登录时间');
			$table->integer('locked_time')->unsigned()->default(0)->comment('锁定时间');
			$table->string('ip', 15)->default('')->comment('用户 ip');
			$table->string('account', 100)->default('')->comment('用户账号,手机号,邮箱或用户名');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_login_attempt');
	}

}
