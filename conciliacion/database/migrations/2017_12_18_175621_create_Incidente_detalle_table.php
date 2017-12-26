<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidenteDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Incidente_detalle', function(Blueprint $table)
		{
			$table->integer('idIncidenteSeguimiento', true);
			$table->integer('idIncidente')->index('fk_Incidente_seguimiento_incidente1_idx');
			$table->integer('idIncidenteFecha')->index('fk_Incidente_seguimiento_incidente_fecha1_idx');
			$table->dateTime('fecha')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Incidente_detalle');
	}

}
