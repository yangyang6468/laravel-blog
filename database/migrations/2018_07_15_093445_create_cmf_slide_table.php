<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfSlideTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_slide', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('createtime')->default(0)->comment('创建时间');
			$table->string('title', 50)->default('')->comment('幻灯片名称');
			$table->string('image')->default('')->comment('幻灯片图片');
			$table->string('url')->default('')->comment('幻灯片链接');
			$table->boolean('status')->default(1)->comment('状态,1:显示;0:隐藏');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->boolean('isdelete')->default(0)->comment('是否删除');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_slide');
	}

}
