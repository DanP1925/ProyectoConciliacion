<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuarioLegalEspecialidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuario_legal_especialidad', function(Blueprint $table)
		{
			$table->foreign('idLegalEspecialidad', 'fk_usuario_legal_has_legal_especialidad_legal_especialidad1')->references('idLegalEspecialidad')->on('legal_especialidad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarioLegal', 'fk_usuario_legal_has_legal_especialidad_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuario_legal_especialidad', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuario_legal_has_legal_especialidad_legal_especialidad1');
			$table->dropForeign('fk_usuario_legal_has_legal_especialidad_usuario_legal1');
		});
	}

}
