<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExpedienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expediente', function(Blueprint $table)
		{
			$table->foreign('idArbitraje', 'fk_expediente_arbitraje')->references('idArbitraje')->on('arbitraje')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idDemandante', 'fk_expediente_cliente_legal1')->references('idClienteLegal')->on('cliente_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idDemandado', 'fk_expediente_cliente_legal2')->references('idClienteLegal')->on('cliente_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCuantiaDeterminada', 'fk_expediente_cuantia_determinada1')->references('idCuantiaDeterminada')->on('cuantia_determinada')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCuantiaTipo', 'fk_expediente_cuantia_tipo1')->references('idCuantiaTipo')->on('cuantia_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idTipoCaso', 'fk_expediente_tipo_caso1')->references('idTipoCaso')->on('tipo_caso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idTipoCasoForma', 'fk_expediente_tipo_caso_forma1')->references('idTipoCasoForma')->on('tipo_caso_forma')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idSecretarioResponsable', 'fk_expediente_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idSecretarioLider', 'fk_expediente_usuario_legal2')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('expediente', function(Blueprint $table)
		{
			$table->dropForeign('fk_expediente_arbitraje');
			$table->dropForeign('fk_expediente_cliente_legal1');
			$table->dropForeign('fk_expediente_cliente_legal2');
			$table->dropForeign('fk_expediente_cuantia_determinada1');
			$table->dropForeign('fk_expediente_cuantia_tipo1');
			$table->dropForeign('fk_expediente_tipo_caso1');
			$table->dropForeign('fk_expediente_tipo_caso_forma1');
			$table->dropForeign('fk_expediente_usuario_legal1');
			$table->dropForeign('fk_expediente_usuario_legal2');
		});
	}

}
