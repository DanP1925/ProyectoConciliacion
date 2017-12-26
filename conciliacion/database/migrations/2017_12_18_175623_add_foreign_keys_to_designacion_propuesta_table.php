<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDesignacionPropuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('designacion_propuesta', function(Blueprint $table)
		{
			$table->foreign('idExpediente', 'fk_designacion_propuesta_expediente1')->references('idExpediente')->on('expediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuario_legal', 'fk_designacion_propuesta_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('designacion_propuesta', function(Blueprint $table)
		{
			$table->dropForeign('fk_designacion_propuesta_expediente1');
			$table->dropForeign('fk_designacion_propuesta_usuario_legal1');
		});
	}

}
