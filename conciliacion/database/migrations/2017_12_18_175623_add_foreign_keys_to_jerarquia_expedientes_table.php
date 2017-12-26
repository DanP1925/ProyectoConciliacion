<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJerarquiaExpedientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jerarquia_expedientes', function(Blueprint $table)
		{
			$table->foreign('idExpediente', 'fk_expediente')->references('idExpediente')->on('expediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idExpedienteAsociado', 'fk_expediente_asociado')->references('idExpediente')->on('expediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jerarquia_expedientes', function(Blueprint $table)
		{
			$table->dropForeign('fk_expediente');
			$table->dropForeign('fk_expediente_asociado');
		});
	}

}
