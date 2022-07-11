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

            // Fields
            $table->string('comm_name_activity');
            $table->mediumText('comm_description_activity', 4000);
            $table->dateTime('comm_date_activity');
            $table->smallInteger('comm_nr_daughters');
            $table->smallInteger('comm_nr_beneficiaries');
            $table->smallInteger('comm_nr_collaborators');

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
        Schema::dropIfExists('community_activities');
    }
}
