<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_userinfos', function(Blueprint $table)
		{
			$table->integer('createtime')->nullable()->default(0)->index('createtime')->comment('创建时间');
			$table->integer('updatetime')->nullable()->default(0)->comment('更新时间');
			$table->integer('id', true)->comment('用户id');
			$table->string('nickname', 20)->nullable()->index('nickname')->comment('昵称');
			$table->string('email', 30)->nullable()->comment('用户邮件');
			$table->string('userpwd', 100)->default('')->index('userpwd')->comment('用户密码');
			$table->integer('birthday')->nullable()->comment('生日');
			$table->boolean('fromsource')->nullable()->index('fromsource')->comment('用户来源');
			$table->string('headimage', 200)->nullable()->comment('用户头像');
			$table->char('phone', 11)->nullable()->index('IDX_userinfo_phone_20161219')->comment('用户手机号');
			$table->boolean('gradeid')->nullable()->default(1)->index('gradeid')->comment('等级id');
			$table->integer('expervalue')->nullable()->default(0)->comment('经验值');
			$table->integer('gender')->nullable()->default(0)->comment('性别 0 保密 1 男 2 女');
			$table->string('signature', 50)->nullable()->comment('个性签名');
			$table->integer('focusnumbymy')->nullable()->default(0)->comment('关注我的人数');
			$table->integer('focusnum')->nullable()->default(0)->index('IDX_userinfo_focusnum_20170208')->comment('我的关注数');
			$table->integer('city')->nullable();
			$table->integer('province')->nullable();
			$table->string('ip', 15)->nullable();
			$table->integer('lastlogindate')->nullable()->default(0)->comment('最后登录时间');
			$table->integer('isdelete')->nullable()->default(0)->index('isdelete')->comment('是否删除');
			$table->boolean('status')->nullable()->default(1)->comment('状态 0 禁用 1 启用');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_userinfos');
	}

}
