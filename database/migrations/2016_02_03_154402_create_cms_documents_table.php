<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_documents', function (Blueprint $table) {
              $table->increments('id');
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('cms_categories');
            $table->string('title',250);
            $table->text('resumen');
            $table->text('content');
            $table->text('main_picture');
            $table->boolean('private');
            $table->dateTime('publish_date');
            $table->boolean('publish');
            $table->text('hits');
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
        Schema::drop('cms_documents');
    }
}
