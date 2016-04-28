<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_comment')->unsigned();
            $table->integer('id_document')->unsigned();
            $table->foreign('id_document')->references('id')->on('cms_documents');
            $table->foreign('id_comment')->references('id')->on('cms_comments');
            $table->string('mail',500);
            $table->string('title',250);
            $table->text('content');
            $table->dateTime('publish_date');
            $table->boolean('publish');
            $table->text('uri');
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
        Schema::drop('cms_comments');
    }
}
