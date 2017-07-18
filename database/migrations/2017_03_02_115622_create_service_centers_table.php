<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_name');
            $table->integer('user_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('metro_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('site');
            $table->string('street');
            $table->string('number_h')->nullable();
            $table->string('number_h_add')->nullable();
            $table->string('c1');
            $table->string('c2');
            $table->string('logo');
            $table->boolean('exit_master')->defoult(0);
            $table->boolean('enabled')->defoult(0);
            $table->boolean('verified')->defoult(0);
            $table->integer('level_verified')->defoult(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_centers');
    }
}
