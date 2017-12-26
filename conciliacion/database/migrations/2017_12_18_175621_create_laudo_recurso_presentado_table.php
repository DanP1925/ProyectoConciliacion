<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaudoRecursoPresentadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laudo_recurso_presentado', function(Blueprint $table)
		{
			$table->integer('idLaudo')->index('fk_laudo_has_laudo_recurso_en_contra_laudo1_idx');
			$table->integer('idLaudoRecursoEnContra')->index('fk_laudo_has_laudo_recurso_en_contra_laudo_recurso_en_contr_idx');
			$table->integer('idLaudoRecursoPresentadoResultado')->index('fk_laudo_recurso_presentado_laudo_recurso_presentado_result_idx');
			$table->dateTime('fechaSolicitud')->nullable();
			$table->dateTime('fechaResultado')->nullable();
			$table->primary(['idLaudo','idLaudoRecursoEnContra']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laudo_recurso_presentado');
	}

}
