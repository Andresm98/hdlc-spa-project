<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_families', function (Blueprint $table) {
            $table->id();

            $table->string('names_father', 50);
            $table->string('names_mother', 50);
            $table->tinyInteger('nr_sisters');
            $table->tinyInteger('nr_brothers');
            $table->tinyInteger('place_of_family');

            // Asignar el campo de clave primaria.
            $table->unsignedBigInteger('profile_id')->unique();

            // Generar las relaciones necesarias.
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
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
        Schema::dropIfExists('info_families');
    }
}