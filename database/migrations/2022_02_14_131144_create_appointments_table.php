a<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Create fields
            $table->string('name_appointment', 100);
            $table->mediumText('description', 2000);
            $table->dateTime('date_appointment');
            $table->dateTime('date_end_appointment')->nullable();

            // Asign field foreign key
            $table->unsignedBigInteger('profile_id')->nullable();

            // Generate foreign key
            $table->foreign('profile_id')
                ->references('id')->on('profiles')
                ->onDelete('set null');

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
        Schema::dropIfExists('appointments');
    }
}
