<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfPortalCategoryPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_portal_category_post', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('post_id')->unsigned()->default(0)->comment('文章id');
			$table->bigInteger('category_id')->unsigned()->default(0)->index('term_taxonomy_id')->comment('分类id');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->boolean('status')->default(1)->comment('状态,1:发布;0:不发布');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_portal_category_post');
	}

}
