<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDocumentAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_document_albums', function (Blueprint $table) {
            $table->increments('id_document')->unsigned();
            $table->foreign('id_document')->references('id')->on('cms_documents');
            $table->integer('id_album')->unsigned();
            $table->foreign('id_album')->references('id')->on('med_albums');
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
        Schema::drop('cms_document_albums');
    }
}
