<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfRecycleBinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_recycle_bin', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('object_id')->nullable()->default(0)->comment('删除内容 id');
			$table->integer('create_time')->unsigned()->nullable()->default(0)->comment('创建时间');
			$table->string('table_name', 60)->nullable()->default('')->comment('删除内容所在表名');
			$table->string('name')->nullable()->default('')->comment('删除内容名称');
			$table->bigInteger('user_id')->unsigned()->default(0)->comment('用户id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_recycle_bin');
	}

}
