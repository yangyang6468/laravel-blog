<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfUserFavoriteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_user_favorite', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->default(0)->index('uid')->comment('用户 id');
			$table->string('title', 100)->default('')->comment('收藏内容的标题');
			$table->string('thumbnail', 100)->default('')->comment('缩略图');
			$table->string('url')->nullable()->comment('收藏内容的原文地址，JSON格式');
			$table->text('description', 65535)->nullable()->comment('收藏内容的描述');
			$table->string('table_name', 64)->default('')->comment('收藏实体以前所在表,不带前缀');
			$table->integer('object_id')->unsigned()->nullable()->default(0)->comment('收藏内容原来的主键id');
			$table->integer('create_time')->unsigned()->nullable()->default(0)->comment('收藏时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_user_favorite');
	}

}
