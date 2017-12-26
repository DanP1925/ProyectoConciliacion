<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesignacionPropuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designacion_propuesta', function(Blueprint $table)
		{
			$table->integer('idDesignacionPropuesta', true);
			$table->integer('idExpediente')->index('fk_designacion_propuesta_expediente1_idx');
			$table->integer('idUsuario_legal')->index('fk_designacion_propuesta_usuario_legal1_idx');
			$table->dateTime('fecha')->nullable();
			$table->char('flagResultado', 1)->nullable()->default('P');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designacion_propuesta');
	}

}
