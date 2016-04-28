<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('men_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_menu')->unsigned();
            $table->foreign('id_menu')->references('id')->on('men_menus');
            $table->integer('id_parent');
            $table->string('title',250);
            $table->text('description');
            $table->string('size',20);
            $table->string('target',20);
            $table->text('uri');
            $table->text('img');
            $table->string('ext',10);            
            $table->integer('level');
            $table->integer('order_by');
            $table->boolean('private');
            $table->boolean('publish');
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
        Schema::drop('men_items');
    }
}
