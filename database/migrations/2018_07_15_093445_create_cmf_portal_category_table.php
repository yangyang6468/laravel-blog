<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfPortalCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_portal_category', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned()->comment('分类id');
			$table->bigInteger('parent_id')->unsigned()->default(0)->comment('分类父id');
			$table->bigInteger('post_count')->unsigned()->default(0)->comment('分类文章数');
			$table->boolean('status')->default(1)->comment('状态,1:发布,0:不发布');
			$table->integer('delete_time')->unsigned()->default(0)->comment('删除时间');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('name', 200)->default('')->comment('分类名称');
			$table->string('description')->default('')->comment('分类描述');
			$table->string('path')->default('')->comment('分类层级关系路径');
			$table->string('seo_title', 100)->default('');
			$table->string('seo_keywords')->default('');
			$table->string('seo_description')->default('');
			$table->string('list_tpl', 50)->default('')->comment('分类列表模板');
			$table->string('one_tpl', 50)->default('')->comment('分类文章页模板');
			$table->text('more', 65535)->nullable()->comment('扩展属性');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_portal_category');
	}

}
