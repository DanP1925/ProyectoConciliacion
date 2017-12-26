<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaJuridicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona_juridica', function(Blueprint $table)
		{
			$table->integer('idPersonaJuridica', true);
			$table->string('nombreComercial', 250)->nullable();
			$table->string('razonSocial', 250)->nullable();
			$table->string('ruc', 20)->nullable();
			$table->string('direccion', 250)->nullable();
			$table->string('telefono', 45)->nullable();
			$table->string('sitioWeb', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persona_juridica');
	}

}
