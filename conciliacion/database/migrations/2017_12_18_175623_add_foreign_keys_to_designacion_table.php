<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDesignacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('designacion', function(Blueprint $table)
		{
			$table->foreign('idDesignacionPropuesta', 'fk_designacion_designacion_propuesta1')->references('idDesignacionPropuesta')->on('designacion_propuesta')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idDesignacionTipo', 'fk_designacion_designacion_tipo1')->references('idDesignacionTipo')->on('designacion_tipo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('designacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_designacion_designacion_propuesta1');
			$table->dropForeign('fk_designacion_designacion_tipo1');
		});
	}

}
