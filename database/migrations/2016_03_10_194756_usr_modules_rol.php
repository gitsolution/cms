<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsrModulesRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('user_module_rol', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_role')->unsigned();
            $table->foreign('id_role')->references('id')->on('usr_roles');
            $table->integer('id_sysmodules')->unsigned();
            $table->foreign('id_sysmodules')->references('id')->on('sys_modules');
            $table->boolean('active');
            $table->text('access_granted');
            $table->integer('resgister_by');
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
        Schema::drop('user_module_rol');
    }
}
