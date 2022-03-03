<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->tinyText('comm_identity_card');
            $table->string('comm_name');
            $table->string('comm_slug')->unique();
            $table->tinyText('comm_cellphone');
            $table->tinyText('comm_phone');
            $table->string('comm_email')->unique();
            $table->dateTime('date_fndt_comm');
            $table->dateTime('date_fndt_work');
            $table->integer('rn_collaborators');

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
        Schema::dropIfExists('communities');
    }
}
