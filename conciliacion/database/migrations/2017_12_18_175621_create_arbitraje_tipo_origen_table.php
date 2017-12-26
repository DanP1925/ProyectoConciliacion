<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArbitrajeTipoOrigenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arbitraje_tipo_origen', function(Blueprint $table)
		{
			$table->integer('idArbitrajeTipoOrigen', true);
			$table->string('nombre', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arbitraje_tipo_origen');
	}

}
