<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaudoRecursoPresentadoResultadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laudo_recurso_presentado_resultado', function(Blueprint $table)
		{
			$table->integer('idLaudoRecursoPresentadoResultado', true);
			$table->integer('idLaudoRecursoEnContra')->index('fk_laudo_recurso_presentado_resultado_laudo_recurso_en_cont_idx');
			$table->string('nombre', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laudo_recurso_presentado_resultado');
	}

}
