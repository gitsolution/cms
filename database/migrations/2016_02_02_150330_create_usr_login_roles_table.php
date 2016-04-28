<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsrLoginRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('usr_login_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_login')->unsigned();
            $table->foreign('id_login')->references('id')->on('users');
            $table->integer('id_role')->unsigned();
            $table->foreign('id_role')->references('id')->on('usr_roles');
            $table->boolean('active');
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
        Schema::drop('usr_login_roles');
    }
}
