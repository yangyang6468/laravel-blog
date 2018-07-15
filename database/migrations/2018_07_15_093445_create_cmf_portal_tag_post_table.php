<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfPortalTagPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_portal_tag_post', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('tag_id')->unsigned()->default(0)->comment('标签 id');
			$table->bigInteger('post_id')->unsigned()->default(0)->index('post_id')->comment('文章 id');
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
		Schema::drop('cmf_portal_tag_post');
	}

}
