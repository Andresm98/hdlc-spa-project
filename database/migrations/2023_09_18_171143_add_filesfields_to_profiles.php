<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesfieldsToProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('profiles', 'date_other_country')) {

            Schema::table('profiles', function (Blueprint $table) {
                $table->dropColumn(['date_other_country', 'place_other_country', 'box', 'page', 'ph_docs', 'dg_docs']);

                $table->dropForeign(['book_id']);

                $table->dropColumn(['book_id']);
            });
        }

        Schema::table('profiles', function (Blueprint $table) {
            $table->dateTime('date_other_country')->nullable();
            $table->text('place_other_country')->nullable();
            $table->text('box')->nullable();
            $table->integer('page')->nullable();
            $table->tinyInteger('ph_docs')->nullable();
            $table->tinyInteger('dg_docs')->nullable();
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
