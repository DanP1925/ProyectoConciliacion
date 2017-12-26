<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClienteLegalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cliente_legal', function(Blueprint $table)
		{
			$table->foreign('idClienteLegalTipo', 'fk_cliente_legal_cliente_legal_tipo1')->references('idClienteLegalTipo')->on('cliente_legal_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idConsorcioEmpresa', 'fk_cliente_legal_consorcio_empresa1')->references('idConsorcioCliente')->on('consorcio_cliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idPersonaJuridica', 'fk_cliente_legal_empresa1')->references('idPersonaJuridica')->on('persona_juridica')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idPersonaNatural', 'fk_cliente_legal_persona')->references('idPersonaNatural')->on('persona_natural')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarioLegal', 'fk_cliente_legal_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cliente_legal', function(Blueprint $table)
		{
			$table->dropForeign('fk_cliente_legal_cliente_legal_tipo1');
			$table->dropForeign('fk_cliente_legal_consorcio_empresa1');
			$table->dropForeign('fk_cliente_legal_empresa1');
			$table->dropForeign('fk_cliente_legal_persona');
			$table->dropForeign('fk_cliente_legal_usuario_legal1');
		});
	}

}
