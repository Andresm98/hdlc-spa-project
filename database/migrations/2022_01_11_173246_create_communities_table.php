<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {

            $table->id();
            $table->tinyInteger('comm_status');
            $table->unsignedBigInteger('comm_id')->nullable();
            $table->tinyText('comm_identity_card')->nullable();
            $table->string('comm_name');
            $table->string('comm_slug')->unique();
            $table->smallInteger('comm_level');
            $table->tinyText('comm_cellphone');
            $table->tinyText('comm_phone');
            $table->string('comm_email')->unique();
            $table->dateTime('date_fndt_comm');
            $table->dateTime('date_fndt_work')->nullable();
            $table->dateTime('date_close')->nullable();
            $table->integer('rn_collaborators')->nullable();

            // Generar campo para clave foranea

            $table->unsignedBigInteger('pastoral_id');

            // Generar la clave foranea recursiva

            $table->foreign('comm_id')
                ->references('id')
                ->on('communities')
                ->onUpdate('set null')
                ->onDelete('cascade');

            $table->foreign('pastoral_id')
                ->references('id')
                ->on('pastorals')
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
        Schema::dropIfExists('communities');
    }
}
