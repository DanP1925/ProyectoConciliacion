<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJerarquiaExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jerarquia_expedientes', function(Blueprint $table)
		{
			$table->integer('idExpediente');
			$table->integer('idExpedienteAsociado')->index('fk_expediente_asociado_idx');
			$table->integer('numeroNivel')->nullable();
			$table->char('flgTope', 1)->nullable();
			$table->char('flgFondo', 1)->nullable();
			$table->primary(['idExpediente','idExpedienteAsociado']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jerarquia_expedientes');
	}

}
