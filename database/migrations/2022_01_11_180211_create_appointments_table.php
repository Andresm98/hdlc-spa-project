a<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateAppointmentsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();

                // Create fields
                $table->mediumText('description', 2000);
                $table->dateTime('date_appointment');
                $table->dateTime('date_end_appointment')->nullable();


                // Asign field foreign key
                $table->unsignedBigInteger('appointment_level_id');
                $table->unsignedBigInteger('profile_id');
                $table->unsignedBigInteger('community_id');
                $table->unsignedBigInteger('transfer_id')->nullable();


                // Generate foreign key

                $table->foreign('appointment_level_id')
                    ->references('id')
                    ->on('appointment_levels')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('profile_id')
                    ->references('id')
                    ->on('profiles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('community_id')
                    ->references('id')
                    ->on('communities')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('transfer_id')
                    ->references('id')
                    ->on('transfers')
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
            Schema::dropIfExists('appointments');
        }
    }
