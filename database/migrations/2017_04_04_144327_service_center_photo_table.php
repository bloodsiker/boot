<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCenterPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_center_photo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_center_id')->unsigned();
            $table->string('path');
            $table->string('file_name');
            $table->string('file_name_mini');
            $table->string('type');

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
        Schema::dropIfExists('service_center_photo');
    }
}
