<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_category', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned()->comment('分类id');
			$table->bigInteger('parent_id')->unsigned()->default(0)->comment('分类父id');
			$table->bigInteger('post_count')->unsigned()->default(0)->comment('分类文章数');
			$table->boolean('status')->default(1)->comment('状态,1:启用,0:不启用');
			$table->integer('delete_time')->unsigned()->default(0)->comment('删除时间');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->string('name', 200)->default('')->comment('分类名称');
			$table->string('description')->default('')->comment('分类描述');
			$table->boolean('isdelete')->default(0)->comment('是否删除');
			$table->integer('create_at')->default(0)->comment('创建时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_category');
	}

}
