<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConsorcioClienteDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('consorcio_cliente_detalle', function(Blueprint $table)
		{
			$table->foreign('idConsorcioEmpresa', 'fk_consorcio_empresa_has_empresa_consorcio_empresa1')->references('idConsorcioCliente')->on('consorcio_cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idPersonaJuridica', 'fk_consorcio_empresa_has_empresa_empresa1')->references('idPersonaJuridica')->on('persona_juridica')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idPersonaNatural', 'fk_consorcio_persona_natural_has_persona_natural')->references('idPersonaNatural')->on('persona_natural')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('consorcio_cliente_detalle', function(Blueprint $table)
		{
			$table->dropForeign('fk_consorcio_empresa_has_empresa_consorcio_empresa1');
			$table->dropForeign('fk_consorcio_empresa_has_empresa_empresa1');
			$table->dropForeign('fk_consorcio_persona_natural_has_persona_natural');
		});
	}

}
