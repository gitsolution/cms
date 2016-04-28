<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use App\Http\Requests;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('active')->default(0);
            $table->string('confirm_token', 100);
            $table->integer('register_by'); 
            $table->integer('modify_by');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name'=>'Admin',
            'lastName'=>'Admin',
            'email'=>'admin@admin',
            'password'=>'itsolution',
            'active'=>'1',
            'confirm_token'=>'',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
