<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfPluginTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_plugin', function(Blueprint $table)
		{
			$table->increments('id')->comment('自增id');
			$table->boolean('type')->default(1)->comment('插件类型;1:网站;8:微信');
			$table->boolean('has_admin')->default(0)->comment('是否有后台管理,0:没有;1:有');
			$table->boolean('status')->default(1)->comment('状态;1:开启;0:禁用');
			$table->integer('create_time')->unsigned()->default(0)->comment('插件安装时间');
			$table->string('name', 50)->default('')->comment('插件标识名,英文字母(惟一)');
			$table->string('title', 50)->default('')->comment('插件名称');
			$table->string('demo_url', 50)->default('')->comment('演示地址，带协议');
			$table->string('hooks')->default('')->comment('实现的钩子;以“,”分隔');
			$table->string('author', 20)->default('')->comment('插件作者');
			$table->string('author_url', 50)->default('')->comment('作者网站链接');
			$table->string('version', 20)->default('')->comment('插件版本号');
			$table->string('description')->comment('插件描述');
			$table->text('config', 65535)->nullable()->comment('插件配置');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_plugin');
	}

}
