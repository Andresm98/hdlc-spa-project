<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_levels', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('appointment_levelc_id')->nullable();

            $table->string('name');
            $table->string('description');
            $table->smallInteger('level');
            $table->tinyText('last_level');



            // Generar la clave foranea recursiva

            $table->foreign('appointment_levelc_id')
                ->references('id')
                ->on('appointment_levels')
                ->onDelete('cascade')
                ->onUpdate('cascade');


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
        Schema::dropIfExists('appointment_levels');
    }
}
