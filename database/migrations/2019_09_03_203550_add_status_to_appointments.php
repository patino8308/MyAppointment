<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //RESERVADA, CONFIRMADA, ATENDIDA Y CANCELADA
            $table->string('status')->default('Reservada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //RESERVADA, CONFIRMADA, ATENDIDA Y CANCELADA
            $table->dropColumn('status');
        });
    }
}
