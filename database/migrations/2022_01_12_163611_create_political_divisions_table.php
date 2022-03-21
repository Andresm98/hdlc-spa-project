<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticalDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('political_divisions', function (Blueprint $table) {

            $table->string('id');

            $table->string('political_divisionc_id')->nullable();

            $table->string('name');
            $table->smallInteger('level');
            $table->tinyText('last_level');


            $table->primary(['id']);

            // Generar la clave foranea recursiva

            $table->foreign('political_divisionc_id')
                ->references('id')
                ->on('political_divisions')
                ->onDelete('cascade');



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
        Schema::dropIfExists('political_divisions');
    }
}
