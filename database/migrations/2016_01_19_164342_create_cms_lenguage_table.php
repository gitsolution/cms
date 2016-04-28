<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsLenguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_language', function (Blueprint $table) {
            $table->increments('id');
            $table->text('label');
            $table->text('description');
            $table->text('code');            
            $table->text('short_code');
            $table->text('status');
            $table->text('active');
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
        Schema::drop('cms_language');
    }
}
