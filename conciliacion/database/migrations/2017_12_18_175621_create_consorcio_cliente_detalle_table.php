<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsorcioClienteDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consorcio_cliente_detalle', function(Blueprint $table)
		{
			$table->integer('idConsorcioEmpresa')->index('fk_consorcio_empresa_has_empresa_consorcio_empresa1_idx');
			$table->integer('idPersonaJuridica')->index('fk_consorcio_empresa_has_empresa_empresa1_idx');
			$table->integer('idPersonaNatural')->index('fk_consorcio_persona_natural_has_persona_natural_idx');
			$table->primary(['idConsorcioEmpresa','idPersonaJuridica','idPersonaNatural']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('consorcio_cliente_detalle');
	}

}
