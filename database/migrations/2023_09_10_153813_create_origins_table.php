<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOriginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origins', function (Blueprint $table) {
            $table->string('address', 100);

            $table->unsignedBigInteger('originable_id');
            $table->string('originable_type');

            $table->string('political_division_id')->nullable();

            $table->primary(['originable_id', 'originable_type']);
            $table->foreign('political_division_id')
                ->references('id')
                ->on('political_divisions')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('origins');
    }
}
