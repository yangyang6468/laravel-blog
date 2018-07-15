<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserLikeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_like', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->default(0)->index('uid')->comment('用户 id');
			$table->integer('object_id')->unsigned()->default(0)->comment('内容原来的主键id');
			$table->integer('create_time')->unsigned()->default(0)->comment('创建时间');
			$table->string('table_name', 64)->default('')->comment('内容以前所在表,不带前缀');
			$table->string('url')->default('')->comment('内容的原文地址，不带域名');
			$table->string('title', 100)->default('')->comment('内容的标题');
			$table->string('thumbnail', 100)->default('')->comment('缩略图');
			$table->text('description', 65535)->nullable()->comment('内容的描述');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_like');
	}

}
