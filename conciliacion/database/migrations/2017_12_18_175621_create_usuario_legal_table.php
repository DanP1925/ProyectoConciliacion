<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioLegalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_legal', function(Blueprint $table)
		{
			$table->integer('idUsuario_legal', true);
			$table->integer('idUsuarioLegalTipo')->index('fk_usuario_legal_usuario_legal_tipo1_idx');
			$table->integer('idUsuarioLegalProfesion')->index('fk_usuario_legal_usuario_legal_profesion1_idx');
			$table->integer('idUsuarioLegalPais')->index('fk_usuario_legal_usuario_legal_pais1_idx');
			$table->string('nombre', 250)->nullable();
			$table->string('apellidoPaterno', 250)->nullable();
			$table->string('apellidoMaterno', 250)->nullable();
			$table->string('dni', 10)->nullable();
			$table->string('email', 250)->nullable();
			$table->string('telefono', 250)->nullable();
			$table->string('rutaCv', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario_legal');
	}

}
