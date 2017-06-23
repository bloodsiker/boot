<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('r_id', 10)->unique();
            $table->string('pagename')->nullable();
            $table->string('service_center_id', 50)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->string('city')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('manufacturer')->nullable();
            $table->string('services')->nullable();
            $table->string('cost_of_work', 50)->nullable();
            $table->string('cost_of_work_end', 50)->nullable();
            $table->text('task_description');
            $table->string('payment_method')->nullable();
            $table->string('exit_master', 50)->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_requests');
    }
}
