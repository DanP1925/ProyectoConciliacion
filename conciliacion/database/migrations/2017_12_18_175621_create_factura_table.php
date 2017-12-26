<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factura', function(Blueprint $table)
		{
			$table->integer('idFactura', true);
			$table->integer('idExpediente')->index('fk_factura_expediente1_idx');
			$table->integer('idSecretarioArbitral')->index('fk_factura_usuario_legal1_idx');
			$table->integer('idCliente')->index('fk_cliente_idx');
			$table->integer('idFacturaConcepto')->index('fk_factura_factura_concepto1_idx');
			$table->integer('idFacturaEstado')->index('fk_factura_factura_estado1_idx');
			$table->string('numeroComprobante', 45)->nullable();
			$table->dateTime('fechaNotificacion')->nullable();
			$table->dateTime('fechaEmision')->nullable();
			$table->dateTime('fechaVencimiento')->nullable();
			$table->decimal('importeInicial', 10, 0)->nullable();
			$table->decimal('importeParcial', 10, 0)->nullable();
			$table->decimal('importePendiente', 10, 0)->nullable();
			$table->text('observacionEstado', 65535)->nullable();
			$table->text('observacionPlazosPago', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('factura');
	}

}
