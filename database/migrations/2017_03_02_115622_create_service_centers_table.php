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
            $table->integer('metro_id')->unsigned()->default(0);
            $table->integer('district_id')->unsigned();
            $table->string('street');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('metro_id')
                ->references('id')->on('metros')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('district_id')
                ->references('id')->on('districts')
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
