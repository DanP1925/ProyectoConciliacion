<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArbitrajeRegionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitraje_region', function(Blueprint $table)
		{
			$table->integer('idArbitraje')->index('fk_arbitraje_has_region_arbitraje1_idx');
			$table->integer('idRegion')->index('fk_arbitraje_has_region_region1_idx');
			$table->primary(['idArbitraje','idRegion']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arbitraje_region');
	}

}
