<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuario', function(Blueprint $table)
		{
			$table->foreign('idPerfil', 'fk_usuario_perfil1')->references('idPerfil')->on('perfil')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUser')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuario', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuario_perfil1');
			$table->dropForeign('usuario_iduser_foreign');
		});
	}

}
