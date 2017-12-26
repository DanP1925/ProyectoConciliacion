<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioLegalEspecialidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_legal_especialidad', function(Blueprint $table)
		{
			$table->integer('idUsuarioLegal')->index('fk_usuario_legal_has_legal_especialidad_usuario_legal1_idx');
			$table->integer('idLegalEspecialidad')->index('fk_usuario_legal_has_legal_especialidad_legal_especialidad1_idx');
			$table->primary(['idUsuarioLegal','idLegalEspecialidad']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario_legal_especialidad');
	}

}
