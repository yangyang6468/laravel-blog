<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_comment', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('parent_id')->unsigned()->default(0)->index('parent_id')->comment('被回复的评论id');
			$table->integer('user_id')->unsigned()->default(0)->comment('发表评论的用户id');
			$table->integer('to_user_id')->unsigned()->default(0)->comment('被评论的用户id');
			$table->integer('object_id')->unsigned()->default(0)->index('object_id')->comment('评论内容 id');
			$table->integer('like_count')->unsigned()->default(0)->comment('点赞数');
			$table->integer('dislike_count')->unsigned()->default(0)->comment('不喜欢数');
			$table->integer('floor')->unsigned()->default(0)->comment('楼层数');
			$table->integer('create_time')->unsigned()->default(0)->index('create_time')->comment('评论时间');
			$table->integer('delete_time')->unsigned()->default(0)->comment('删除时间');
			$table->boolean('status')->default(1)->index('status')->comment('状态,1:已审核,0:未审核');
			$table->boolean('type')->default(1)->comment('评论类型；1实名评论');
			$table->string('table_name', 64)->default('')->comment('评论内容所在表，不带表前缀');
			$table->string('full_name', 50)->default('')->comment('评论者昵称');
			$table->string('email')->default('')->comment('评论者邮箱');
			$table->string('path')->default('')->comment('层级关系');
			$table->text('url', 65535)->nullable()->comment('原文地址');
			$table->text('content', 65535)->nullable()->comment('评论内容');
			$table->text('more', 65535)->nullable()->comment('扩展属性');
			$table->index(['table_name','object_id','status'], 'table_id_status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_comment');
	}

}
