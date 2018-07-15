<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfAssetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_asset', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->unsigned()->default(0)->comment('用户id');
			$table->bigInteger('file_size')->unsigned()->default(0)->comment('文件大小,单位B');
			$table->integer('create_time')->unsigned()->default(0)->comment('上传时间');
			$table->boolean('status')->default(1)->comment('状态;1:可用,0:不可用');
			$table->integer('download_times')->unsigned()->default(0)->comment('下载次数');
			$table->string('file_key', 64)->default('')->comment('文件惟一码');
			$table->string('filename', 100)->default('')->comment('文件名');
			$table->string('file_path', 100)->default('')->comment('文件路径,相对于upload目录,可以为url');
			$table->string('file_md5', 32)->default('')->comment('文件md5值');
			$table->string('file_sha1', 40)->default('');
			$table->string('suffix', 10)->default('')->comment('文件后缀名,不包括点');
			$table->text('more', 65535)->nullable()->comment('其它详细信息,JSON格式');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_asset');
	}

}
