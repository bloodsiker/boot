<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCenterPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_center_phone', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_center_id')->unsigned();
            $table->string('phone');

            $table->foreign('service_center_id')
                ->references('id')->on('service_centers')
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
        Schema::dropIfExists('service_center_phone');
    }
}
