<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfPortalPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_portal_post', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('parent_id')->unsigned()->default(0)->index('parent_id')->comment('父级id');
			$table->boolean('post_type')->default(1)->comment('类型,1:文章;2:页面');
			$table->boolean('post_format')->default(1)->comment('内容格式;1:html;2:md');
			$table->bigInteger('user_id')->unsigned()->default(0)->index('user_id')->comment('发表者用户id');
			$table->boolean('post_status')->default(1)->comment('状态;1:已发布;0:未发布;');
			$table->boolean('comment_status')->default(1)->comment('评论状态;1:允许;0:不允许');
			$table->boolean('is_top')->default(0)->comment('是否置顶;1:置顶;0:不置顶');
			$table->boolean('recommended')->default(0)->comment('是否推荐;1:推荐;0:不推荐');
			$table->bigInteger('post_hits')->unsigned()->default(0)->comment('查看数');
			$table->integer('post_favorites')->unsigned()->default(0)->comment('收藏数');
			$table->bigInteger('post_like')->unsigned()->default(0)->comment('点赞数');
			$table->bigInteger('comment_count')->unsigned()->default(0)->comment('评论数');
			$table->integer('create_time')->unsigned()->default(0)->index('create_time')->comment('创建时间');
			$table->integer('update_time')->unsigned()->default(0)->comment('更新时间');
			$table->integer('published_time')->unsigned()->default(0)->comment('发布时间');
			$table->integer('delete_time')->unsigned()->default(0)->comment('删除时间');
			$table->string('post_title', 100)->default('')->comment('post标题');
			$table->string('post_keywords', 150)->default('')->comment('seo keywords');
			$table->string('post_excerpt', 500)->default('')->comment('post摘要');
			$table->string('post_source', 150)->default('')->comment('转载文章的来源');
			$table->string('thumbnail', 100)->default('')->comment('缩略图');
			$table->text('post_content', 65535)->nullable()->comment('文章内容');
			$table->text('post_content_filtered', 65535)->nullable()->comment('处理过的文章内容');
			$table->text('more', 65535)->nullable()->comment('扩展属性,如缩略图;格式为json');
			$table->index(['post_type','post_status','create_time','id'], 'type_status_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_portal_post');
	}

}
