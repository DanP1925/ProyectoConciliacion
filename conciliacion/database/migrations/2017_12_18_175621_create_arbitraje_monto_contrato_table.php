<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArbitrajeMontoContratoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitraje_monto_contrato', function(Blueprint $table)
		{
			$table->integer('idArbitrajeMontoContrato', true);
			$table->string('nombre')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arbitraje_monto_contrato');
	}

}
