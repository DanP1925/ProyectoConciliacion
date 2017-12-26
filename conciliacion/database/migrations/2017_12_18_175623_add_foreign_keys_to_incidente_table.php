<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIncidenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('incidente', function(Blueprint $table)
		{
			$table->foreign('idExpediente', 'fk_incidente_expediente1')->references('idExpediente')->on('expediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIncidenteTipo', 'fk_incidente_incidente_tipo1')->references('idIncidenteTipo')->on('incidente_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idSecretario', 'fk_incidente_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('incidente', function(Blueprint $table)
		{
			$table->dropForeign('fk_incidente_expediente1');
			$table->dropForeign('fk_incidente_incidente_tipo1');
			$table->dropForeign('fk_incidente_usuario_legal1');
		});
	}

}
