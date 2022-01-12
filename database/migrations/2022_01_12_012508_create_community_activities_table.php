<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_activities', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description', 100);
            $table->text('observation');
            $table->date('date');

            // Generar el campo

            $table->unsignedBigInteger('community_id');

            // Asignar el valor al campo

            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
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
        Schema::dropIfExists('community_activities');
    }
}
