<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_route', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('路由id');
			$table->float('list_order', 10, 0)->default(10000)->comment('排序');
			$table->boolean('status')->default(1)->comment('状态;1:启用,0:不启用');
			$table->boolean('type')->default(1)->comment('URL规则类型;1:用户自定义;2:别名添加');
			$table->string('full_url')->default('')->comment('完整url');
			$table->string('url')->default('')->comment('实际显示的url');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_route');
	}

}
