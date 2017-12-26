<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpedienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expediente', function(Blueprint $table)
		{
			$table->integer('idExpediente', true);
			$table->integer('idSecretarioResponsable')->index('fk_expediente_usuario_legal1_idx');
			$table->integer('idSecretarioLider')->index('fk_expediente_usuario_legal2_idx');
			$table->integer('idDemandante')->index('fk_expediente_cliente_legal1_idx');
			$table->integer('idDemandado')->index('fk_expediente_cliente_legal2_idx');
			$table->integer('idCuantiaDeterminada')->index('fk_expediente_cuantia_determinada1_idx');
			$table->integer('idCuantiaTipo')->index('fk_expediente_cuantia_tipo1_idx');
			$table->integer('idTipoCaso')->index('fk_expediente_tipo_caso1_idx');
			$table->integer('idTipoCasoForma')->index('fk_expediente_tipo_caso_forma1_idx');
			$table->integer('idArbitraje')->index('fk_expediente_arbitraje_idx');
			$table->string('numero', 20)->nullable();
			$table->dateTime('fechaSolicitud')->nullable();
			$table->decimal('cuantiaControversia', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('expediente');
	}

}
