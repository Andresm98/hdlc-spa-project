<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            $table->dateTime('transfer_date_adission');
            $table->dateTime('transfer_date_relocated')->nullable();
            $table->string('transfer_reason', 100);
            $table->text('transfer_observation', 4000);

            // Asignar la relacion

            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('office_id');

            // Generar la clave foranea.

            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                // ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('office_id')
                ->references('id')
                ->on('offices')
                // ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
                // ->onDelete('cascade')
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
        Schema::dropIfExists('transfers');
    }
}
