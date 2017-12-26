<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArbitrajeEquipoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitraje_equipo', function(Blueprint $table)
		{
			$table->integer('idArbitrajeEquipo', true);
			$table->integer('idArbitraje')->index('fk_arbitraje_equipo_arbitraje1_idx');
			$table->integer('idArbitroDemandante')->index('fk_arbitraje_equipo_usuario_legal1_idx');
			$table->integer('idArbitroDemandado')->index('fk_arbitraje_equipo_usuario_legal2_idx');
			$table->integer('idPresidenteTribunal')->index('fk_arbitraje_equipo_usuario_legal3_idx');
			$table->integer('idArbitroUnico')->index('fk_arbitraje_equipo_usuario_legal4_idx');
			$table->string('emailArbitroDemandante', 250)->nullable();
			$table->string('emailArbitroDemandado', 250)->nullable();
			$table->string('emailPresidenteTribunal', 250)->nullable();
			$table->string('emailArbitroUnico', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arbitraje_equipo');
	}

}
