<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaudoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laudo', function(Blueprint $table)
		{
			$table->integer('idLaudo', true);
			$table->integer('idArbitraje')->index('fk_laudo_arbitraje1_idx');
			$table->integer('idLaudoEstado')->index('fk_laudo_laudo_estado1_idx');
			$table->integer('idLaudoTipoEjecucion')->index('fk_laudo_laudo_tipo_ejecucion1_idx');
			$table->integer('idLaudoResultado')->index('fk_laudo_laudo_resultado1_idx');
			$table->integer('idLaudoResultadoPersona')->index('fk_laudo_laudo_resultado_persona1_idx');
			$table->integer('idLaudoResultadoForma')->index('fk_laudo_laudo_resultado_forma1_idx');
			$table->decimal('monto', 10, 0)->nullable();
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
		Schema::drop('laudo');
	}

}
