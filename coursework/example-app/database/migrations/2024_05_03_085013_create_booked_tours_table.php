<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_tours', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tour');
            $table->integer('count_children');
            $table->integer('count_adults');
            $table->text('wishes');
            $table->text('response');
            $table->string('tel');
            $table->string('email');
            $table->integer('id_status_application');
            $table->integer('id_user');
            $table->integer('id_employees');
            $table->integer('date_application');
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
        Schema::dropIfExists('booked_tours');
    }
};
