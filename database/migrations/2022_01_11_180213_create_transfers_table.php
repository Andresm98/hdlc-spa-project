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

            $table->dateTime('adission');
            $table->dateTime('relocated')->nullable();
            $table->string('colocation', 40);
            $table->text('observation');

            // Asignar la relacion

            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('office_id');

            // Generar la clave foranea.

            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onUpdate('cascade');
            // ->onDelete('cascade');

            $table->foreign('office_id')
                ->references('id')
                ->on('offices')
                ->onUpdate('cascade');
            // ->onDelete('cascade');

            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
                ->onUpdate('cascade');
            // ->onDelete('cascade');

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
