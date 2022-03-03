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
            $table->string('name', 100);
            $table->mediumText('description', 2000);
            $table->tinyInteger('nr_daughters');
            $table->tinyInteger('nr_collaborators');

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
        Schema::dropIfExists('community_resumes');
    }
}
