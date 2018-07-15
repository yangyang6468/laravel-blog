<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserScoreLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_score_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('user_id')->default(0)->comment('用户 id');
			$table->integer('create_time')->default(0)->comment('创建时间');
			$table->string('action', 50)->default('')->comment('用户操作名称');
			$table->integer('score')->default(0)->comment('更改积分，可以为负');
			$table->integer('coin')->default(0)->comment('更改金币，可以为负');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_score_log');
	}

}
