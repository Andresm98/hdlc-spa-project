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

            $table->tinyText('identity_card');
            $table->dateTime('date_birth');
            $table->dateTime('date_vocation')->nullable();
            $table->dateTime('date_admission')->nullable();
            $table->dateTime('date_send')->nullable();
            $table->dateTime('date_vote')->nullable();
            $table->dateTime('date_death')->nullable();
            $table->char('cellphone', 20);
            $table->char('phone', 20);
            $table->longText('observation', 4000);

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
