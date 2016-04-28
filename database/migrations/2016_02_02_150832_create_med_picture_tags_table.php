<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedPictureTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('med_picture_tags', function (Blueprint $table) {
            $table->integer('id_picture')->unsigned();            
            $table->foreign('id_picture')->references('id')->on('med_pictures');
            $table->integer('id_tag')->unsigned();
            $table->foreign('id_tag')->references('id')->on('cat_tags');
            $table->boolean('active');
            $table->integer('register_by');
            $table->integer('modify');
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
        Schema::drop('med_picture_tags');
    }
}
