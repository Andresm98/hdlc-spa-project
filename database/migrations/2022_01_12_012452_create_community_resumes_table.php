<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_resumes', function (Blueprint $table) {
            $table->id();

            // Fields
            $table->string('comm_name_resume');
            $table->string('comm_annexed_resume', 400);
            $table->mediumText('comm_observation_resume', 4000);
            $table->dateTime('comm_date_resume');
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
        Schema::dropIfExists('community_resumes');
    }
}
