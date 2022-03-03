<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_visits', function (Blueprint $table) {
            $table->id();

            //  Fields
            $table->string('reason', 100);
            $table->string('type', 50);
            $table->mediumText('description', 4000);
            $table->dateTime('date_init');
            $table->dateTime('date_end');

            // FK field
            $table->unsignedBigInteger('community_id');

            // Asign relashionship
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
        Schema::dropIfExists('community_visits');
    }
}
