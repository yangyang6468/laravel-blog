<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfLinkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_link', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('status')->default(1)->index('status')->comment('状态;1:显示;0:不显示');
			$table->integer('rating')->default(0)->comment('友情链接评级');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('description')->default('')->comment('友情链接描述');
			$table->string('url')->default('')->comment('友情链接地址');
			$table->string('name', 30)->default('')->comment('友情链接名称');
			$table->string('image', 100)->default('')->comment('友情链接图标');
			$table->string('target', 10)->default('')->comment('友情链接打开方式');
			$table->string('rel', 50)->default('')->comment('链接与网站的关系');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_link');
	}

}
