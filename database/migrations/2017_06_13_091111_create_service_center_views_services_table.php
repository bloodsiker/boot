<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCenterViewsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_center_views_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_center_id')->nullable();
            $table->string('type_device')->nullable();
            $table->string('services');
            $table->date('date_view');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_center_views_services');
    }
}
