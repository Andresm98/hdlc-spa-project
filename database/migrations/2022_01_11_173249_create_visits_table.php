<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            //  Fields
            $table->string('comm_reason_visit', 100);
            $table->tinyInteger('comm_type_visit');
            $table->mediumText('comm_description_visit', 4000);
            $table->dateTime('comm_date_init_visit');
            $table->dateTime('comm_date_end_visit');

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
        Schema::dropIfExists('visits');
    }
}
