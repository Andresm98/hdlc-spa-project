<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoFamilyBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_family_breaks', function (Blueprint $table) {
            $table->id();

            $table->string('name_family_member',100);
            $table->string('relation',100);
            $table->char('cellphone', 20);
            $table->char('phone', 20);

            // Asignar la relacion con info_family.
            $table->unsignedBigInteger('info_family_id')->unique();

            // Generar la clave foranea.
            $table->foreign('info_family_id')
                ->references('id')
                ->on('info_families')
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
        Schema::dropIfExists('info_family_breaks');
    }
}
