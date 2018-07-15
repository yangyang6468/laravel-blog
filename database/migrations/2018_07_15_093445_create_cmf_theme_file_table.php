<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfThemeFileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_theme_file', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->boolean('is_public')->default(0)->comment('是否公共的模板文件');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('theme', 20)->default('')->comment('模板名称');
			$table->string('name', 20)->default('')->comment('模板文件名');
			$table->string('action', 50)->default('')->comment('操作');
			$table->string('file', 50)->default('')->comment('模板文件，相对于模板根目录，如Portal/index.html');
			$table->string('description', 100)->default('')->comment('模板文件描述');
			$table->text('more', 65535)->nullable()->comment('模板更多配置,用户自己后台设置的');
			$table->text('config_more', 65535)->nullable()->comment('模板更多配置,来源模板的配置文件');
			$table->text('draft_more', 65535)->nullable()->comment('模板更多配置,用户临时保存的配置');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_theme_file');
	}

}
