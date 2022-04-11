<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description', 2000)->nullable();
            $table->string('color')->nullable();
            $table->double('price', 15, 2)->nullable();
            /*
                1 = Madera
                2 =Tela
                3 = Plastico
                4 = Metal
                5 = Yeso
            */
            $table->tinyInteger('material');
            /*
                1 = Mala
                2 = Regular
                3 = Buena
                4 = Muy Buena
                5 = Excelente
            */
            $table->tinyInteger('status');
            $table->string('size')->nullable();
            $table->string('brand')->nullable();
            // FK field

            $table->unsignedBigInteger('section_id');

            // Asign relashionship

            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
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
        Schema::dropIfExists('articles');
    }
}
