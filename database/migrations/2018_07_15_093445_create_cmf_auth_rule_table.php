<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfAuthRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_auth_rule', function(Blueprint $table)
		{
			$table->increments('id')->comment('规则id,自增主键');
			$table->boolean('status')->default(1)->comment('是否有效(0:无效,1:有效)');
			$table->string('app', 40)->default('')->comment('规则所属app');
			$table->string('type', 30)->default('')->comment('权限规则分类，请加应用前缀,如admin_');
			$table->string('name', 100)->default('')->unique('name')->comment('规则唯一英文标识,全小写');
			$table->string('param', 100)->default('')->comment('额外url参数');
			$table->string('title', 20)->default('')->comment('规则描述');
			$table->string('condition', 200)->default('')->comment('规则附加条件');
			$table->index(['app','status','type'], 'module');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_auth_rule');
	}

}
