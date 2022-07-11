<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_trainings', function (Blueprint $table) {
            $table->id();

            // Crear los campos necesarios a ser migrados a la base de datos
            $table->string('name_title', 100);
            $table->string('institution', 50);
            $table->dateTime('date_title');
            $table->text('observation');

            // Asignar el campo la clave foranea
            $table->unsignedBigInteger('profile_id')->nullable();

            // Generar la clave foranea para la relacion uno a muchos (profile->academic_training)
            $table->foreign('profile_id')
                ->references('id')->on('profiles')
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
        Schema::dropIfExists('academic_trainings');
    }
}
