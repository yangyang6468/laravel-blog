<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfThemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_theme', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('create_time')->unsigned()->default(0)->comment('安装时间');
			$table->integer('update_time')->unsigned()->default(0)->comment('最后升级时间');
			$table->boolean('status')->default(0)->comment('模板状态,1:正在使用;0:未使用');
			$table->boolean('is_compiled')->default(0)->comment('是否为已编译模板');
			$table->string('theme', 20)->default('')->comment('主题目录名，用于主题的维一标识');
			$table->string('name', 20)->default('')->comment('主题名称');
			$table->string('version', 20)->default('')->comment('主题版本号');
			$table->string('demo_url', 50)->default('')->comment('演示地址，带协议');
			$table->string('thumbnail', 100)->default('')->comment('缩略图');
			$table->string('author', 20)->default('')->comment('主题作者');
			$table->string('author_url', 50)->default('')->comment('作者网站链接');
			$table->string('lang', 10)->default('')->comment('支持语言');
			$table->string('keywords', 50)->default('')->comment('主题关键字');
			$table->string('description', 100)->default('')->comment('主题描述');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_theme');
	}

}
