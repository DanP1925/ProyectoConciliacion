<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidenteFechaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incidente_fecha', function(Blueprint $table)
		{
			$table->integer('idIncidenteFecha', true);
			$table->integer('idIncidenteTipo')->index('fk_incidente_fecha_incidente_tipo1_idx');
			$table->text('nombre', 65535)->nullable();
			$table->integer('orden')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incidente_fecha');
	}

}
