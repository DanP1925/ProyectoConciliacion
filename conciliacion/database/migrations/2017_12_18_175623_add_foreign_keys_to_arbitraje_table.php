<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArbitrajeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arbitraje', function(Blueprint $table)
		{
			$table->foreign('idArbitrajeEstado', 'fk_arbitraje_arbitraje_estado2')->references('idArbitrajeEstado')->on('arbitraje_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitrajeMontoContrato', 'fk_arbitraje_arbitraje_monto_contrato1')->references('idArbitrajeMontoContrato')->on('arbitraje_monto_contrato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitrajePeritaje', 'fk_arbitraje_arbitraje_peritaje1')->references('idArbitrajePeritaje')->on('arbitraje_peritaje')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idArbitrajeTipoOrigen', 'fk_arbitraje_arbitraje_tipo_origen2')->references('idArbitrajeTipoOrigen')->on('arbitraje_tipo_origen')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCorteArbitraje', 'fk_arbitraje_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arbitraje', function(Blueprint $table)
		{
			$table->dropForeign('fk_arbitraje_arbitraje_estado2');
			$table->dropForeign('fk_arbitraje_arbitraje_monto_contrato1');
			$table->dropForeign('fk_arbitraje_arbitraje_peritaje1');
			$table->dropForeign('fk_arbitraje_arbitraje_tipo_origen2');
			$table->dropForeign('fk_arbitraje_usuario_legal1');
		});
	}

}
