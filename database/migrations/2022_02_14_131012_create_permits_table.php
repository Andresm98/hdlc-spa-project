<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();

            // Attibutes

            $table->string('reason', 100);
            $table->text('description', 2000);
            $table->dateTime('date_province');
            $table->dateTime('date_general');
            $table->dateTime('date_out');
            $table->dateTime('date_in')->nullable();

            //  Create fields

            $table->unsignedBigInteger('profile_id')->nullable();

            //  Generate foreing key

            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('set null');


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
        Schema::dropIfExists('permits');
    }
}
