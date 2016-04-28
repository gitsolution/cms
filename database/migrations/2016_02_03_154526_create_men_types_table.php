<?php

use Illuminate\Database\Schema\Blueprint;
use App\TypeMenu;
use Illuminate\Database\Migrations\Migration;

class CreateMenTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('men_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',250);
            $table->text('description');
            $table->text('uri');
            $table->integer('order_by');
            $table->datetime('publish');
            $table->boolean('active');
            $table->integer('register_by');
            $table->integer('modify_by');
            $table->timestamps();
        });
    
      TypeMenu::create([
            'title'=>'main_menu',
            'description'=>'Posición del Menú Principal',
            'uri'=>' ',
            'order_by'=>'1',
            'publish'=>'1',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1' ,           
        ]);


         TypeMenu::create([
            'title'=>'footer_menu',
            'description'=>'Posición del menú en el Footer',
            'uri'=>' ',
            'order_by'=>'2',
            'publish'=>'1',
            'active'=>'1',
            'register_by'=>'1',
            'modify_by'=>'1',            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('men_types');
    }
}
