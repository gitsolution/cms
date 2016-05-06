<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::create('pp_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->double('price');
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('active');
            $table->boolean('active_price');
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
         Schema::drop('pp_prices');
    }
}
