<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFacturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('factura', function(Blueprint $table)
		{
			$table->foreign('idCliente', 'fk_cliente')->references('idClienteLegal')->on('cliente_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idExpediente', 'fk_factura_expediente1')->references('idExpediente')->on('expediente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idFacturaConcepto', 'fk_factura_factura_concepto1')->references('idFacturaConcepto')->on('factura_concepto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idFacturaEstado', 'fk_factura_factura_estado1')->references('idFacturaEstado')->on('factura_estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idSecretarioArbitral', 'fk_factura_usuario_legal1')->references('idUsuario_legal')->on('usuario_legal')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('factura', function(Blueprint $table)
		{
			$table->dropForeign('fk_cliente');
			$table->dropForeign('fk_factura_expediente1');
			$table->dropForeign('fk_factura_factura_concepto1');
			$table->dropForeign('fk_factura_factura_estado1');
			$table->dropForeign('fk_factura_usuario_legal1');
		});
	}

}
