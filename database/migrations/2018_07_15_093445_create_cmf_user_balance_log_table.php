<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserBalanceLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_balance_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('user_id')->default(0)->comment('用户 id');
			$table->integer('create_time')->unsigned()->default(0)->comment('创建时间');
			$table->decimal('change', 10)->default(0.00)->comment('更改余额');
			$table->decimal('balance', 10)->default(0.00)->comment('更改后余额');
			$table->string('description')->default('')->comment('描述');
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
		Schema::drop('cmf_user_balance_log');
	}

}
