<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('sys_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_directory')->unsigned();
            $table->foreign('id_directory')->references('id')->on('sys_directories');
            $table->string('title',250);
            $table->text('description');
            $table->text('uri');
            $table->boolean('publish');
            $table->dateTime('publish_date');
            $table->text('path');
            $table->string('mime_type',20);
            $table->string('extension',20);
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
        //
    }
}
