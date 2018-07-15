<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserActionLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_action_log', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->default(0)->comment('用户id');
			$table->integer('count')->unsigned()->default(0)->comment('访问次数');
			$table->integer('last_visit_time')->unsigned()->default(0)->comment('最后访问时间');
			$table->string('object', 100)->default('')->comment('访问对象的id,格式:不带前缀的表名+id;如posts1表示xx_posts表里id为1的记录');
			$table->string('action', 50)->default('')->comment('操作名称;格式:应用名+控制器+操作名,也可自己定义格式只要不发生冲突且惟一;');
			$table->string('ip', 15)->default('')->comment('用户ip');
			$table->index(['user_id','object','action'], 'user_object_action');
			$table->index(['user_id','object','action','ip'], 'user_object_action_ip');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_action_log');
	}

}
