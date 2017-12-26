<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArbitrajeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitraje', function(Blueprint $table)
		{
			$table->integer('idArbitraje', true);
			$table->integer('idArbitrajeTipoOrigen')->index('fk_arbitraje_arbitraje_tipo_origen2_idx');
			$table->integer('idArbitrajeEstado')->index('fk_arbitraje_arbitraje_estado2_idx');
			$table->integer('idArbitrajePeritaje')->index('fk_arbitraje_arbitraje_peritaje1_idx');
			$table->integer('idArbitrajeMontoContrato')->index('fk_arbitraje_arbitraje_monto_contrato1_idx');
			$table->integer('idCorteArbitraje')->index('fk_arbitraje_usuario_legal1_idx');
			$table->integer('añoContrato')->nullable();
			$table->dateTime('fechaInstalacion')->nullable();
			$table->dateTime('fechaAFPC')->nullable();
			$table->dateTime('fechaInformeOral')->nullable();
			$table->dateTime('fechaDesignacionCorteArbitraje')->nullable();
			$table->char('flagReconvencion', 1)->nullable()->default('N');
			$table->char('flagLiquidacion', 1)->nullable()->default('N');
			$table->char('flagReliquidacion', 1)->nullable()->default('N');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arbitraje');
	}

}
