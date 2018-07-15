<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('user_type')->default(1)->comment('用户类型;1:admin;2:会员');
			$table->boolean('sex')->default(0)->comment('性别;0:保密,1:男,2:女');
			$table->integer('birthday')->default(0)->comment('生日');
			$table->integer('last_login_time')->default(0)->comment('最后登录时间');
			$table->integer('score')->default(0)->comment('用户积分');
			$table->integer('coin')->unsigned()->default(0)->comment('金币');
			$table->decimal('balance', 10)->default(0.00)->comment('余额');
			$table->integer('create_time')->default(0)->comment('注册时间');
			$table->boolean('user_status')->default(1)->comment('用户状态;0:禁用,1:正常,2:未验证');
			$table->string('user_login', 60)->default('')->index('user_login')->comment('用户名');
			$table->string('user_pass', 64)->default('')->comment('登录密码;cmf_password加密');
			$table->string('user_nickname', 50)->default('')->index('user_nickname')->comment('用户昵称');
			$table->string('user_email', 100)->default('')->comment('用户登录邮箱');
			$table->string('user_url', 100)->default('')->comment('用户个人网址');
			$table->string('avatar')->default('')->comment('用户头像');
			$table->string('signature')->default('')->comment('个性签名');
			$table->string('last_login_ip', 15)->default('')->comment('最后登录ip');
			$table->string('user_activation_key', 60)->default('')->comment('激活码');
			$table->string('mobile', 20)->default('')->comment('中国手机不带国家代码，国际手机号格式为：国家代码-手机号');
			$table->text('more', 65535)->nullable()->comment('扩展属性');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user');
	}

}
