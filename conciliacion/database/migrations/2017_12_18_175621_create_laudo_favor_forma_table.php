<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaudoFavorFormaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laudo_favor_forma', function(Blueprint $table)
		{
			$table->integer('idLaudoFormaForma', true);
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
		Schema::drop('laudo_favor_forma');
	}

}
