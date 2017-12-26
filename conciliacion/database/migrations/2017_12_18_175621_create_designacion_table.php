<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesignacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designacion', function(Blueprint $table)
		{
			$table->integer('idDesignacion', true);
			$table->integer('idDesignacionTipo')->index('fk_designacion_designacion_tipo1_idx');
			$table->integer('idDesignacionPropuesta')->index('fk_designacion_designacion_propuesta1_idx');
			$table->dateTime('fecha')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designacion');
	}

}
