<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLaudoRecursoPresentadoResultadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('laudo_recurso_presentado_resultado', function(Blueprint $table)
		{
			$table->foreign('idLaudoRecursoEnContra', 'fk_laudo_recurso_presentado_resultado_laudo_recurso_en_contra1')->references('idLaudoRecursoEnContra')->on('laudo_recurso_en_contra')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('laudo_recurso_presentado_resultado', function(Blueprint $table)
		{
			$table->dropForeign('fk_laudo_recurso_presentado_resultado_laudo_recurso_en_contra1');
		});
	}

}
