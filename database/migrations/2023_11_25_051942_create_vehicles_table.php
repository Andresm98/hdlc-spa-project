<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('brand', 100);
            $table->string('type', 100);
            $table->string('color', 100);
            $table->string('plaque', 100);
            $table->dateTime('year')->nullable();

            // FK field
            $table->unsignedBigInteger('community_id');

            // Asign relashionship
            $table->foreign('community_id')
                ->references('id')
                ->on('communities')
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
        Schema::dropIfExists('vehicles');
    }
}
