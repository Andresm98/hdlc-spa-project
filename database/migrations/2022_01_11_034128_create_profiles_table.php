<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            //  1 = Activa, 2 = Fallecida, 3 = Retirada, 4 = Envio otros paises, 5 = Sin DATOS
            $table->tinyInteger('status');
            $table->tinyText('identity_card');
            $table->tinyText('iess_card')->nullable();
            $table->tinyText('driver_license')->nullable();
            $table->dateTime('date_birth');
            $table->dateTime('date_vocation')->nullable();
            $table->dateTime('date_admission')->nullable();
            $table->dateTime('date_send')->nullable();
            $table->dateTime('date_vote')->nullable();
            $table->dateTime('date_death')->nullable();
            $table->dateTime('date_exit')->nullable();
            $table->dateTime('date_retirement')->nullable();
            $table->char('cellphone', 20)->nullable();
            $table->char('phone', 20)->nullable();
            $table->longText('observation', 4000)->nullable();

            // Asignar el campo de clave primaria.
            $table->unsignedBigInteger('user_id')->unique();

            // Generar las relaciones necesarias.
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('profiles');
    }
}
