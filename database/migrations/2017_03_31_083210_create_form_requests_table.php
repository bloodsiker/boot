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
            $table->integer('service_center_id')->unsigned();
            $table->string('user_id', 50)->nullable();
            $table->string('city')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('manufacturer')->nullable();
            $table->string('services')->nullable();
            $table->decimal('cost_of_work_min', 10, 2)->nullable();
            $table->decimal('cost_of_work_max', 10, 2)->nullable();
            $table->decimal('cost_of_work_end', 10, 2)->nullable();
            $table->text('task_description');
            $table->string('payment_method')->nullable();
            $table->string('exit_master', 50)->nullable();
            $table->text('client_address');
            $table->string('deadline', 50)->nullable();
            $table->text('comment');
            $table->integer('status_id')->unsigned();
            $table->text('cancel_comment');
            $table->boolean('favorite')->default(0);
            $table->boolean('notif_email')->default(0);
            $table->timestamps();

            $table->foreign('service_center_id')
                ->references('id')->on('service_centers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('status_id')
                ->references('id')->on('request_status')
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
        Schema::dropIfExists('form_requests');
    }
}
