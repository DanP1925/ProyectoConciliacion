<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArbitrajeRegionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arbitraje_region', function(Blueprint $table)
		{
			$table->foreign('idArbitraje', 'fk_arbitraje_has_region_arbitraje1')->references('idArbitraje')->on('arbitraje')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idRegion', 'fk_arbitraje_has_region_region1')->references('idRegion')->on('region')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arbitraje_region', function(Blueprint $table)
		{
			$table->dropForeign('fk_arbitraje_has_region_arbitraje1');
			$table->dropForeign('fk_arbitraje_has_region_region1');
		});
	}

}
