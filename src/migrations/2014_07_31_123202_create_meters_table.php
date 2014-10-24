<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('meters', function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->integer('user_id')->unsigned();
                $table->integer('metric_id')->unsigned()->nullable();
                $table->string('name');
                
                $table->foreign('user_id')->references('id')->on('users')
                                        ->onUpdate('restrict')
                                        ->onDelete('cascade');

                $table->foreign('metric_id')->references('id')->on('metrics')
                                        ->onUpdate('restrict')
                                        ->onDelete('set null');
            });
            
            Schema::create('meter_readings', function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->integer('user_id')->unsigned();
                $table->integer('meter_id')->unsigned();
                $table->decimal('reading', 8, 2)->default(0);
                
                $table->foreign('meter_id')->references('id')->on('meters')
                                        ->onUpdate('restrict')
                                        ->onDelete('cascade');
                
                $table->foreign('user_id')->references('id')->on('users')
                                        ->onUpdate('restrict')
                                        ->onDelete('cascade');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('meter_readings');
            Schema::drop('meters');
	}

}