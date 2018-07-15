<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmfAuthAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cmf_auth_access', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('role_id')->unsigned()->index('role_id')->comment('角色');
			$table->string('rule_name', 100)->default('')->index('rule_name')->comment('规则唯一英文标识,全小写');
			$table->string('type', 30)->default('')->comment('权限规则分类,请加应用前缀,如admin_');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmf_auth_access');
	}

}
