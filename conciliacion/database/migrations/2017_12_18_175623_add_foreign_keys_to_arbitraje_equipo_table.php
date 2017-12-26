<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArbitrajeEquipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arbitraje_equipo', function(Blueprint $table)
		{
			$table->foreign('idArbitraje', 'fk_arbitraje_equipo_arbitraje1')->references('idArbitraje')->on('arbitraje')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitroDemandante', 'fk_arbitraje_equipo_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitroDemandado', 'fk_arbitraje_equipo_usuario_legal2')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idPresidenteTribunal', 'fk_arbitraje_equipo_usuario_legal3')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitroUnico', 'fk_arbitraje_equipo_usuario_legal4')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arbitraje_equipo', function(Blueprint $table)
		{
			$table->dropForeign('fk_arbitraje_equipo_arbitraje1');
			$table->dropForeign('fk_arbitraje_equipo_usuario_legal1');
			$table->dropForeign('fk_arbitraje_equipo_usuario_legal2');
			$table->dropForeign('fk_arbitraje_equipo_usuario_legal3');
			$table->dropForeign('fk_arbitraje_equipo_usuario_legal4');
		});
	}

}
