<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfVerificationCodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_verification_code', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned()->comment('表id');
			$table->integer('count')->unsigned()->default(0)->comment('当天已经发送成功的次数');
			$table->integer('send_time')->unsigned()->default(0)->comment('最后发送成功时间');
			$table->integer('expire_time')->unsigned()->default(0)->comment('验证码过期时间');
			$table->string('code', 8)->default('')->comment('最后发送成功的验证码');
			$table->string('account', 100)->default('')->comment('手机号或者邮箱');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_verification_code');
	}

}
