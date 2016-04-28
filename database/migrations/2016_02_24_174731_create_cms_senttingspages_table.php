<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsSenttingspagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_senttingspages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave',500);
            $table->text('value');
           $table->boolean('active');
            $table->integer('register_by');
            $table->integer('modify_by');
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
        Schema::drop('cms_senttingspages');
    }
}
