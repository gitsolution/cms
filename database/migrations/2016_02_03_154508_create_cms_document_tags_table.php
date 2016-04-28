<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsDocumentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_document_tags', function (Blueprint $table) {
            $table->increments('id_document')->unsigned();
            $table->foreign('id_document')->references('id')->on('cms_documents');
            $table->integer('id_tag')->unsigned();
            $table->foreign('id_tag')->references('id')->on('cat_tags');
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
        Schema::drop('cms_document_tags');
    }
}
