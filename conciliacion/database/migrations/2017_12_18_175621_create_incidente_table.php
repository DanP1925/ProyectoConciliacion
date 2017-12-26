<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incidente', function(Blueprint $table)
		{
			$table->integer('idIncidente', true);
			$table->integer('idIncidenteTipo')->index('fk_incidente_incidente_tipo1_idx');
			$table->integer('idExpediente')->index('fk_incidente_expediente1_idx');
			$table->integer('idSecretario')->index('fk_incidente_usuario_legal1_idx');
			$table->text('observaciones', 65535)->nullable();
			$table->char('estado', 1)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidente');
	}

}
