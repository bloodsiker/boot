<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_center_id')->unsigned();
            $table->string('user_name');
            $table->string('device');
            $table->string('service');
            $table->string('service_number');
            $table->text('text');
            $table->unsignedTinyInteger('r_total_rating');
            $table->unsignedTinyInteger('r_quality_of_work');
            $table->unsignedTinyInteger('r_deadlines');
            $table->unsignedTinyInteger('r_compliance_cost');
            $table->unsignedTinyInteger('r_price_quality');
            $table->unsignedTinyInteger('r_service');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('comments');
    }
}
