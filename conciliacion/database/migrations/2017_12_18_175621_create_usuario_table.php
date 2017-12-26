<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->integer('idUsuario', true);
			$table->integer('idPerfil')->index('fk_usuario_perfil1_idx');
			$table->string('nombre')->nullable();
			$table->string('apellidoPaterno')->nullable();
			$table->string('apellidoMaterno')->nullable();
			$table->integer('idUser')->unsigned()->index('usuario_iduser_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
