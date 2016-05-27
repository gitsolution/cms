<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpDetailsReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pp_details_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_price')->unsigned();
            $table->foreign('id_price')->references('id')->on('pp_prices');
            $table->integer('id_reservation')->unsigned();
            $table->foreign('id_reservation')->references('id')->on('pp_reservation');
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
        //
    }
}
