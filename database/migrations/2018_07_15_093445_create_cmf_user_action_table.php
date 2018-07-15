<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_action', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('score')->default(0)->comment('更改积分，可以为负');
			$table->integer('coin')->default(0)->comment('更改金币，可以为负');
			$table->integer('reward_number')->default(0)->comment('奖励次数');
			$table->boolean('cycle_type')->default(0)->comment('周期类型;0:不限;1:按天;2:按小时;3:永久');
			$table->integer('cycle_time')->unsigned()->default(0)->comment('周期时间值');
			$table->string('name', 50)->default('')->comment('用户操作名称');
			$table->string('action', 50)->default('')->comment('用户操作名称');
			$table->string('app', 50)->default('')->comment('操作所在应用名或插件名等');
			$table->text('url', 65535)->nullable()->comment('执行操作的url');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_action');
	}

}
