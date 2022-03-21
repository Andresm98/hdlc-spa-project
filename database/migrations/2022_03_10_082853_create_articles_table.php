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
            $table->string('color');
            $table->double('price', 15, 2);
            $table->string('material');
            $table->string('status');
            $table->string('size');
            $table->string('brand');
            $table->text('description', 4000);

            // FK field

            $table->unsignedBigInteger('section_id');

            // Asign relashionship

            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
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
