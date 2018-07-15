<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_articles', function(Blueprint $table)
		{
			$table->integer('createtime')->nullable()->default(0)->index('idx_createtime')->comment('创建时间');
			$table->integer('updatetime')->nullable()->default(0)->comment('更新时间');
			$table->integer('id', true)->comment('自增标识消息id');
			$table->boolean('category_id')->nullable()->default(0)->index('idx_classifyid')->comment('分类');
			$table->string('title', 100)->nullable()->index('fcnmesgtitle')->comment('消息标题');
			$table->text('info', 16777215)->nullable()->comment('消息内容');
			$table->string('photo', 250)->nullable()->comment('封面图片路径地址');
			$table->integer('collect_count')->nullable()->default(0)->index('idx_fcncollectnum')->comment('收藏次数');
			$table->integer('comment_count')->unsigned()->nullable()->default(0)->index('idx_fcncommentnum')->comment('评论次数');
			$table->integer('click_count')->nullable()->default(0)->index('clickcount')->comment('点击数');
			$table->integer('userid')->nullable()->default(0)->index('idx_frmuserid')->comment('发表用户id');
			$table->integer('sticky')->nullable()->default(0)->index('idx_sticky')->comment('是否置顶0否1是');
			$table->boolean('recommend')->nullable()->default(0)->comment('是否推荐 0 否 1 是');
			$table->integer('stickytime')->nullable()->default(0)->comment('置顶时间');
			$table->integer('status')->nullable()->default(1)->index('idx_shenhe')->comment('审核状态：0不发布 1发布');
			$table->integer('isdelete')->nullable()->default(0)->index('idx_isdelete')->comment('是否删除');
			$table->bigInteger('rewardtotal')->nullable()->default(0)->index('rewardtotal')->comment('打赏总金额');
			$table->bigInteger('rewardcount')->nullable()->default(0)->index('rewardcount')->comment('打赏总人数');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_articles');
	}

}
