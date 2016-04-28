<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_categories', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('id_section')->unsigned();
            $table->foreign('id_section')->references('id')->on('cms_sections');
            $table->string('title',250);
            $table->text('resumen');
            $table->text('content');
            $table->text('main_picture');
            $table->boolean('private');
            $table->dateTime('publish_date');
            $table->boolean('publish');
            $table->text('uri');
            $table->integer('hits');
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
        Schema::drop('cms_categories');
    }
}
