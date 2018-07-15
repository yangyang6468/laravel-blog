<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserTokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_token', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->default(0)->comment('用户id');
			$table->integer('expire_time')->unsigned()->default(0)->comment(' 过期时间');
			$table->integer('create_time')->unsigned()->default(0)->comment('创建时间');
			$table->string('token', 64)->default('')->comment('token');
			$table->string('device_type', 10)->default('')->comment('设备类型;mobile,android,iphone,ipad,web,pc,mac,wxapp');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_token');
	}

}
