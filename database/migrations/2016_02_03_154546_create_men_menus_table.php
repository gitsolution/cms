<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('men_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_men_type')->unsigned();
            $table->foreign('id_men_type')->references('id')->on('men_types');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')->references('id') ->on('cms_language');
            $table->string('title',250);
            $table->text('description');
            $table->text('uri');            
            $table->integer('order_by');
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
        Schema::drop('men_menus');
    }
}
