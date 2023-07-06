<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesinfoToProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {

            $table->dateTime('date_other_country')->nullable();
            $table->text('place_other_country')->nullable();
            $table->text('box')->nullable();
            $table->integer('page')->nullable();
            $table->tinyInteger('ph_docs')->nullable();
            $table->tinyInteger('dg_docs')->nullable();

            $table->unsignedBigInteger('book_id')->nullable();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
}
