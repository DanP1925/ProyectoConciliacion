<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuarioLegalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuario_legal', function(Blueprint $table)
		{
			$table->foreign('idUsuarioLegalPais', 'fk_usuario_legal_usuario_legal_pais1')->references('idUsuarioLegalPais')->on('usuario_legal_pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarioLegalProfesion', 'fk_usuario_legal_usuario_legal_profesion1')->references('idUsuarioLegalProfesion')->on('usuario_legal_profesion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarioLegalTipo', 'fk_usuario_legal_usuario_legal_tipo1')->references('idUsuarioLegalTipo')->on('usuario_legal_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuario_legal', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuario_legal_usuario_legal_pais1');
			$table->dropForeign('fk_usuario_legal_usuario_legal_profesion1');
			$table->dropForeign('fk_usuario_legal_usuario_legal_tipo1');
		});
	}

}
