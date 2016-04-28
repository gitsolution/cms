<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id') ->on('cms_types');
            $table->integer('id_language')->unsigned();
            $table->foreign('id_language')->references('id') ->on('cms_language');
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
        Schema::drop('cms_sections');
    }
}
