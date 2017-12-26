<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLaudoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('laudo', function(Blueprint $table)
		{
			$table->foreign('idArbitraje', 'fk_laudo_arbitraje1')->references('idArbitraje')->on('arbitraje')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoEstado', 'fk_laudo_laudo_estado1')->references('idLaudoEstado')->on('laudo_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoResultado', 'fk_laudo_laudo_resultado1')->references('idLaudoResultado')->on('laudo_resultado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoResultadoForma', 'fk_laudo_laudo_resultado_forma1')->references('idLaudoFormaForma')->on('laudo_favor_forma')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoResultadoPersona', 'fk_laudo_laudo_resultado_persona1')->references('idLaudoFavorPersona')->on('laudo_favor_persona')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLaudoTipoEjecucion', 'fk_laudo_laudo_tipo_ejecucion1')->references('idLaudoTipoEjecucion')->on('laudo_tipo_ejecucion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('laudo', function(Blueprint $table)
		{
			$table->dropForeign('fk_laudo_arbitraje1');
			$table->dropForeign('fk_laudo_laudo_estado1');
			$table->dropForeign('fk_laudo_laudo_resultado1');
			$table->dropForeign('fk_laudo_laudo_resultado_forma1');
			$table->dropForeign('fk_laudo_laudo_resultado_persona1');
			$table->dropForeign('fk_laudo_laudo_tipo_ejecucion1');
		});
	}

}
