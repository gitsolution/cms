<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',250);
            $table->text('description');
            $table->integer('order_by');            
            $table->text('uri');
            $table->boolean('publish');
            $table->dateTime('publish_date');
            $table->text('path');
            $table->boolean('index_page');
            $table->integer('hits');
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
        Schema::drop('med_albums');
    }
}
