<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLaudoRecursoPresentadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('laudo_recurso_presentado', function(Blueprint $table)
		{
			$table->foreign('idLaudo', 'fk_laudo_has_laudo_recurso_en_contra_laudo1')->references('idLaudo')->on('laudo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoRecursoEnContra', 'fk_laudo_has_laudo_recurso_en_contra_laudo_recurso_en_contra1')->references('idLaudoRecursoEnContra')->on('laudo_recurso_en_contra')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoRecursoPresentadoResultado', 'fk_laudo_recurso_presentado_laudo_recurso_presentado_resultado1')->references('idLaudoRecursoPresentadoResultado')->on('laudo_recurso_presentado_resultado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('laudo_recurso_presentado', function(Blueprint $table)
		{
			$table->dropForeign('fk_laudo_has_laudo_recurso_en_contra_laudo1');
			$table->dropForeign('fk_laudo_has_laudo_recurso_en_contra_laudo_recurso_en_contra1');
			$table->dropForeign('fk_laudo_recurso_presentado_laudo_recurso_presentado_resultado1');
		});
	}

}
