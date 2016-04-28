<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsrLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usr_logins', function (Blueprint $table) {

            $table->increments('id');
            $table->string('mail',150);
            $table->string('token',100);
            $table->string('passwd',100);
            $table->boolean('activate_account');
            $table->boolean('active');
            $table->dateTime('modify_by');
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
        Schema::drop('usr_logins');
    }
}
