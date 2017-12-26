<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIncidenteFechaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('incidente_fecha', function(Blueprint $table)
		{
			$table->foreign('idIncidenteTipo', 'fk_incidente_fecha_incidente_tipo1')->references('idIncidenteTipo')->on('incidente_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('incidente_fecha', function(Blueprint $table)
		{
			$table->dropForeign('fk_incidente_fecha_incidente_tipo1');
		});
	}

}
