<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaNaturalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona_natural', function(Blueprint $table)
		{
			$table->integer('idPersonaNatural')->primary();
			$table->string('nombre', 250)->nullable();
			$table->string('apellido Paterno', 250)->nullable();
			$table->string('apellido Materno', 250)->nullable();
			$table->string('dni', 10)->nullable();
			$table->string('email', 250)->nullable();
			$table->string('telefono', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persona_natural');
	}

}
