<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Sacrament;

class CreateSacramentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacraments', function (Blueprint $table) {
            $table->id();
            $table->enum('name', [
                Sacrament::BAUTISMO, Sacrament::PENITENCIA, Sacrament::EUCARISTIA,
                Sacrament::CONFIRMACION, Sacrament::ORDENSACERDOTAL, Sacrament::MATRIMONIO,
                Sacrament::UNIONENFERMOS
            ])->default(Sacrament::BAUTISMO);
            $table->date('date');
            $table->text('observation');

            // Generar el campo
            $table->unsignedBigInteger('profile_id');

            // Asignar el campo necesario a la clave foranea
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
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
        Schema::dropIfExists('sacraments');
    }
}
