<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->date('arrival');
            $table->date('departure');
            $table->integer('room');            
            $table->integer('grownups');
            $table->text('minors');
            $table->text('promotions');
            $table->double('amount');
			$table->text('topic');//Para mercado de pago(Almacena el status del pago puede ser payment(Pagado) o merchan_order(transacción en prceso))
			$table->integer('id_topic');//para posteriormente acerle peticiones a mercado de pago con este id
           
		   /*$table->integer('id_price')->unsigned();
            $table->foreign('id_price')->references('id')->on('pp_prices');*/
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
        Schema::drop('pp_reservation');
    }
}
