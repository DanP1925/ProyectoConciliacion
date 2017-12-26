<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIncidenteDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Incidente_detalle', function(Blueprint $table)
		{
			$table->foreign('idIncidente', 'fk_Incidente_seguimiento_incidente1')->references('idIncidente')->on('incidente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIncidenteFecha', 'fk_Incidente_seguimiento_incidente_fecha1')->references('idIncidenteFecha')->on('incidente_fecha')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Incidente_detalle', function(Blueprint $table)
		{
			$table->dropForeign('fk_Incidente_seguimiento_incidente1');
			$table->dropForeign('fk_Incidente_seguimiento_incidente_fecha1');
		});
	}

}
