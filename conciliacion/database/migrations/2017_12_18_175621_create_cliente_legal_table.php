<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClienteLegalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente_legal', function(Blueprint $table)
		{
			$table->integer('idClienteLegal', true);
			$table->integer('idClienteLegalTipo')->index('fk_cliente_legal_cliente_legal_tipo1_idx');
			$table->integer('idPersonaNatural')->nullable()->index('fk_cliente_legal_persona_idx');
			$table->integer('idPersonaJuridica')->nullable()->index('fk_cliente_legal_empresa1_idx');
			$table->integer('idConsorcioEmpresa')->index('fk_cliente_legal_consorcio_empresa1_idx');
			$table->integer('idUsuarioLegal')->index('fk_cliente_legal_usuario_legal1_idx');
			$table->char('flgEsConsorcio', 1)->nullable();
			$table->char('flgSector', 3)->nullable();
			$table->string('emailUsuarioLegal', 250)->nullable();
			$table->string('telefonoUsuarioLegal', 250)->nullable();
			$table->string('telefonoClienteLegal', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cliente_legal');
	}

}
